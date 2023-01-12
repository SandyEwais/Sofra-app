<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Token;
use App\Models\Restaurant;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\RestaurantResource;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = validator()->make($request->all(),[
            'name' => 'required|max:50',
            'email' => 'required|unique:restaurants',
            'phone' => 'required|unique:restaurants',
            'password' => 'required|confirmed',
            'city_id' => 'required',
            'neighborhood_id' => 'required',
            'category_id' => 'required',
            'minimum_charge' => 'required',
            'delivery_fees' => 'required',
            'contact_phone' => 'required',
            'whatsapp' => 'required',
            'image' => 'required'

        ]);
        if($validator->fails()){
            return responseJson('0','failure',$validator->errors());
        }
        $request->merge(['password'=> bcrypt($request->password)]);
        $restaurant = Restaurant::create($request->all());
        $token = $restaurant->createToken("API TOKEN FOR " . $restaurant->name);
        
        return responseJson('1','success',[
            'restaurant' => new RestaurantResource($restaurant),
            'api_token' =>$token->plainTextToken
        ]);
    }

    public function login(Request $request){
        $validator = validator()->make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'

        ]);
        if($validator->fails()){
            return responseJson('0','failure',$validator->errors());
        }
        $restaurant = Restaurant::where('email',$request->email)->first();
        if($restaurant){
            if(Hash::check($request->password, $restaurant->password)){
                return responseJson('1','success',[
                    'resta$restaurant' => new RestaurantResource($restaurant),
                    'api_token' => $restaurant->createToken("API TOKEN FOR ". $restaurant->name)->plainTextToken
                ]);
            }else{
                return responseJson('0','failure','credenials not valid');
            }
        }else{
            return responseJson('0','failure','credenials not valid');
        }
    }
    public function forgotPassword(Request $request){
        $validator = validator()->make($request->all(),[
            'email' => 'required'
        ]);
        if($validator->fails()){
            return responseJson('0','failure',$validator->errors());
        }
        $restaurant = Restaurant::where('email',$request->email)->first();
        if($restaurant){
            $code = rand(1111111,9999999);
            $update = $restaurant->update(['pin_code' => $code]);
            if($update){
                //email
                Mail::to($restaurant->email)->send(new ResetPassword($code));
                
                return responseJson('1','Please Kindly Check Your Email',[
                    'pin_code' => $code
                ]);
            }else{
                return responseJson('0','failure','something went wrong, please try again');
            }

        }else{
            return responseJson('0','failure','invalid email');
        }
    }

    public function resetPassword(Request $request){
        $validator = validator()->make($request->all(),[
            'pin_code' => 'required|NotIn:0',
            'password' => 'required|confirmed'
        ]);
        if($validator->fails()){
            return responseJson('0','failure',$validator->errors());
        }
        $restaurant = Restaurant::where('pin_code',$request->pin_code)->first();
        if($restaurant){
            $restaurant->pin_code = null;
            $restaurant->password = bcrypt($request->password);
            if($restaurant->save()){
                return responseJson('1','Password Has Been Updated Successfully');
            }else{
                return responseJson('0','something went wrong, please try again');
            }

        }else{
            return responseJson('0','invalid code');
        }
    }

    public function profile(Request $request){
        $validator = validator()->make($request->all(),[
            'name' => Rule::unique('restaurants')->ignore($request->user()->id),
            'email' => Rule::unique('restaurants')->ignore($request->user()->id),
            'phone' => Rule::unique('restaurants')->ignore($request->user()->id),
            'neighborhood_id' => Rule::exists('neighborhoods','id'),
            'city_id' => Rule::exists('cities','id'),
            'category_id' => Rule::exists('categories','id'),
            'state' => 'In:open,closed',

        ]);
        if($validator->fails()){
            return responseJson('0',$validator->errors()->first(),$validator->errors());
        }
        $client = $request->user();
        if($request->password){
            $request->merge(['password'=> bcrypt($request->password)]);
        }
        $client->update($request->all());

        return new RestaurantResource($request->user()->fresh());
    }

    public function registerToken(Request $request){
        $validator = validator()->make($request->all(),[
            'token' => 'required',
            'device_type' => 'required|In:android,ios'
        ]);
        if($validator->fails()){
            return responseJson('0','failure',$validator->errors());
        }
        Token::where('token',$request->token)->delete();
        $request->user()->ctokens()->create($request->all());
        return responseJson('1','success');
    }

    public function removeToken(Request $request){
        $validator = validator()->make($request->all(),[
            'token' => 'required'
        ]);
        if($validator->fails()){
            return responseJson('0','failure',$validator->errors());
        }
        Token::where('token',$request->token)->delete();
        return responseJson('1','success');
        
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return responseJson(200,'success','You Are Logged Out');

    }
}
