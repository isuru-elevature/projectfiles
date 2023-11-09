<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function redirectToProvider()
    {
        Log::info('Redirect to Actionstep initiated.');

        $query = http_build_query([
            'client_id' => config('services.actionstep.client_id'),
            'redirect_uri' => config('services.actionstep.redirect_url'),
            'response_type' => 'code',
            'scope' => 'all',
        ]);

        return redirect(config('services.actionstep.auth_url') . '?' . $query);
    }

    public function handleProviderCallback(Request $request)
    {
        Log::info('Handling provider callback.');
        try {
            $response = Http::asForm()->post(config('services.actionstep.token_url'), [
                'grant_type' => 'authorization_code',
                'client_id' => config('services.actionstep.client_id'),
                'client_secret' => config('services.actionstep.client_secret'),
                'redirect_uri' => config('services.actionstep.redirect_url'),
                'code' => $request->code
            ]);

            if ($response->successful()) {
                $tokenData = $response->json();
                Log::info('Token data received', $tokenData);

                // Store the token data in the session or user model
                Session::put('access_token', $tokenData['access_token']);
                Session::put('refresh_token', $tokenData['refresh_token']);
                Session::put('expires_in', $tokenData['expires_in']);
                Log::info('Session access_token set: ' . Session::get('access_token'));

                // Redirect to the dashboard or wherever you need
                Log::info('Redirecting to dashboard');

                $response = Http::withHeaders([
                    "Authorization" => "Bearer $tokenData[access_token]",
                    "Content-Type" => "application/vnd.api+json",
                    "Accept" => "application/vnd.api+json"
                ])->get('https://ap-southeast-2.actionstep.com/api/rest/users/current?include=participant');

                dd($response->json());
                // if($response->successful()){
                //     dd($response->json()); a
                // }
                //return redirect()->to('/dashboard');


                // hardcoded the bearer which is attacked to joseph@elevature the auth key needs to be dynamic 
                // I already did this no permission
            } else {
                Log::error('Error during token exchange', $response->json());
                // Handle the error, perhaps redirect to an error page or display a message

                //did you get it? but you are loging in in api as helloelevature but in the db in here we dont have the hello elevature email.. how can we authenticate that this email is the one they logged in
                //I think we cant access the user bud if we are using the users token.. i think they dont have permissions
                // if we change the access token the one generated in the $tokenData we can't.. we dont have permission.. as wyou can see we hard coded the token and its displaying joseph email and not the hello email
                // nah we logged in with the joseph email


                // so the problem is we dont have username and password in our db.. if we have username and password in the returned token data we could create the user then add Auth:;loginusingid() to properly login
                // but since we dont have the user its kinda difficult to work around the authentication. i see. do you have any solutions for this? try laravel sanctum but I only know about it is if has the user and
                // password in the db.. not sure how to authenticate using only the token.  a DEFAULT db user can be used for all users that login through actionstep. so admin@gmail.com and the associated password can be use.
                // that way after the user logs in with actionstep that default email and password is used to give them access to the database. yowu hgaot what if in the api we have a different user that its not in the db user
                // how could we authenticate that. since that user and password is only the in the api db and not in db user. once the token is returned from actionstep we know that the user is a valid user so the  yeah id bk nowthat
                // but in order for laravel to know that the user is logged in is u need to add Auth:;login(''user or passsword, or id); since the return data is only token how can we tell laravel that you are logged in..
                // it doesnt matter what account is used on  yeathe hiknow but you need to tell laravel that find this user in the db cause its the one that logins.. that how laravel works in logging in.. maybe in laravel sanctum
                // there is a method that only accepts the token and set the authentication status to logged in. . oNIce  havtehn' tried that in sanctum.. but I know sanctum can logged in using a token then look at the db to find
                // the user of the token then set status ass logged in. cant a user account like admin@gmail.com be used for all actionstep logins. so after the token is recieved the login() function is called and the hardcoded email
                //and password are passed to the db to clear the db login. if the login() can be called with admin@gmail.com every time we know that the user has been able to login with actionstep. so if a legit token has been recieved                //you mean one of those emails in users table? yeah can we enter a user hello@elevature.com.au? like ythat? we can but 
            
                //I think we just need to rebuild the auth so that auth is taken from a different model. if the user has a legitimate actionstep account and we have gotten their token log the token on maybe a new database table
                // allong with the rest of the Actionstep details of the user. then we can remove all the old db users and have purely actionstep users in the db. but the actionstep api only returns the token.. their is no othere
                // credentials given aside from the tokens
                // does laravel require there be a email and password? can this not be changed so that auth is triggered to be true as long as the user has logged in with actionstep? we would need to fully rebuild the all the auth code tho. 
                // we can do that thing you said, if there is token we can logged in using the admin email.. but the problem with that is everything he changed or added, its the admin email user that will be put in the logs and not the
                // real user that logged in in action step. 
                // could we log the user in with a default email and password and create another db table to differentiate the users properly? so it stores their authkey and other info etc. or will that not work with laravel sessioning.
                // could we try to login if the token is change every login
            }
        } catch (\Exception $e) {
            Log::error('Exception during token exchange: ' . $e->getMessage());
            // Handle the exception, perhaps redirect to an error page or display a message
        }
    }
}
