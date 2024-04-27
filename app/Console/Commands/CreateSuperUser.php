<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-super-user {email?} {mobileNumber?} {username?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create super user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->checkEmail();
        $fullname = $this->checkFullname();
        $mobileNumber = $this->checkMobile();
        $username = $this->checkUsername();
        $gender = $this->checkGender();
        $password = $this->checkPassword();

        /** @var User */
        $user = User::create([
            'email' => $email,
            'fullname' => $fullname,
            'mobile_number' => $mobileNumber,
            'username' => $username,
            'gender' => $gender,
            'password' => Hash::make($password)
        ]);

        $user->markEmailAsVerified();
        $user->assignRole(1);

        $this->info("Super admin account created");
    }

    protected function checkEmail()
    {
        $started = false;
        $input = $this->argument('email');
        
        while (true) {
            $validator = Validator::make([
                'email' => $input
            ], [
                'email' => 'required|email:filter|max:250|unique:users'
            ]);

            if (!$validator->fails()) {
                break;
            } elseif (!$started) {
                $started = true;
            } else {
                $this->warn($validator->errors()->first('email'));
            }

            $input = $this->ask('Enter email address');
        }

        return $input;
    }

    protected function checkMobile()
    {
        $started = false;
        $input = $this->argument('mobileNumber');

        while (true) {
            $validator = Validator::make([
                'mobile_number' => $input
            ], [
                'mobile_number' => 'required|phone:NG|min:3|max:50|unique:users'
            ]);

            if (!$validator->fails()) {
                break;
            } elseif (!$started) {
                $started = true;
            } else {
                $this->warn($validator->errors()->first('mobile_number'));
            }

            $input = $this->ask('Enter Mobile Number');
        }

        return $input;
    }

    protected function checkUsername()
    {
        $started = false;
        $input = $this->argument('username');

        while (true) {
            $validator = Validator::make([
                'username' => $input
            ], [
                'username' => 'required|string|min:3|max:50|unique:users'
            ]);
    
            if (!$validator->fails()) {
                break;
            } elseif (!$started) {
                $started = true;
            } else {
                $this->warn($validator->errors()->first('username'));
            }

            $input = $this->ask('Enter Username');
        }

        return $input;
    }

    protected function checkFullname()
    {
        $started = false;
        $input = $this->argument('username');

        while (true) {
            $validator = Validator::make([
                'fullname' => $input
            ], [
                'fullname' => 'required|string|min:3|max:50'
            ]);
    
            if (!$validator->fails()) {
                break;
            } elseif (!$started) {
                $started = true;
            } else {
                $this->warn($validator->errors()->first('fullname'));
            }

            $input = $this->ask('Enter Full Name');
        }

        return $input;
    }

    protected function checkGender()
    {
        $input = $this->choice(
            'Select gender',
            [
                'None',
                'male',
                'female'
            ], 
            'None'
        );

        return $input;
    }

    protected function checkPassword()
    {
        $started = false;
        $input = '';
        $input_confirmation = '';
        
        while (true) {
            $validator = Validator::make([
                'input' => $input,
                'input_confirmation' => $input_confirmation
            ], [
                'input' => 'required|min:8|confirmed'
            ]);
            
            if (!$validator->fails()) {
                break;
            } elseif (!$started) {
                $started = true;
            } else {
                $this->warn($validator->errors()->first('input'));
            }

            $input = $this->secret('Enter Password');
            $input_confirmation = $this->secret('Confirm Password');
        }

        return $input;
    }
}
