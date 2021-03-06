<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Session;
use App\User;
use Auth;


class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRegister(){
        $data=['name'=>'Arman','email'=>'arman@gmail.com','password'=>'tormuj69' ,'password_confirmation'=>'tormuj69','role'=>'0','NID'=>'123456789','age'=>'20'];
        $response=$this->json('POST', '/register',$data);
        // dd($response->getContent());
       
        $this->assertDatabaseHas('users', [
            'email'=>'arman@gmail.com'
        ]);
        $this->assertDatabaseHas('users', [
            'NID'=>'123456789'
        ]);
        $this->assertDatabaseHas('users', [
            'role'=>'0'
        ]);
        $this->assertDatabaseHas('users', [
            'age'=>'20'
        ]);
    }

    public function testLogin(){
        $data=['email'=>'arman@gmail.com','password'=>'tormuj69' ];
        $response=$this->json('POST', '/login',$data);
        $this->assertEquals($data['email'],Auth::user()->email);
    }





    public function testDashboard(){
        $response=$this->get("/dashboard");
        $response->assertStatus(302);
    }


    public function testHasAdmin(){
        $this->assertDatabaseHas('users', [
            'role'=>'1'
        ]);
    }







}
