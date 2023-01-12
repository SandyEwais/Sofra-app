<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Token;
use App\Models\Client;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\ClientResource;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = validator()->make($request->all(),[
            'name' => 'required|max:50',
            'email' => 'required|unique:clients',
            'phone' => 'required|unique:clients',
            'password' => 'required|confirmed',
            'city_id' => 'required',
            'neighborhood_id' => 'required'

        ]);
        if($validator->fails()){
            return responseJson('0','failure',$validator->errors());
        }
        $request->merge(['password'=> bcrypt($request->password)]);
        $client = Client::create($request->all());
        //$client->api_token = Str::random(60);
        //$client->save();
        $token = $client->createToken("API TOKEN FOR " . $client->name);
        
        return responseJson('1','success',[
            'client' => new ClientResource($client),
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
        $client = Client::where('email',$request->email)->first();
        if($client){
            if(Hash::check($request->password, $client->password)){
                return responseJson('1','success',[
                    'client' => new ClientResource($client),
                    'api_token' => $client->createToken("API TOKEN FOR ". $client->name)->plainTextToken
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
        $client = Client::where('email',$request->email)->first();
        if($client){
            $code = rand(1111111,9999999);
            $update = $client->update(['pin_code' => $code]);
            if($update){
                //email
                Mail::to($client->email)->send(new ResetPassword($code));
                
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
        $client = Client::where('pin_code',$request->pin_code)->first();
        if($client){
            $client->pin_code = null;
            $client->password = bcrypt($request->password);
            if($client->save()){
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
            'name' => Rule::unique('clients')->ignore($request->user()->id),
            'email' => Rule::unique('clients')->ignore($request->user()->id),
            'phone' => Rule::unique('clients')->ignore($request->user()->id),
            'neighborhood_id' => Rule::exists('neighborhood','id')
        ]);
        if($validator->fails()){
            return responseJson('0',$validator->errors()->first(),$validator->errors());
        }
        $client = $request->user();
        if($request->password){
            $request->merge(['password'=> bcrypt($request->password)]);
        }
        $client->update($request->all());

        return new ClientResource($request->user()->fresh());
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
