<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    public $user_id, $name, $email, $password, $users;
    public $updateMode = false;

    public function render()
    {
        $this->users = User::all();
        return view('livewire.users');
    }

    public function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'User Created Successfully');


        $this->resetInputFields();
        $this->dispatch('userStore');
        // return $this->redirect('/users');
    }

    public function edit($id){

        $this->updateMode = true;
        $user = User::where('id', $id)->first();

        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }
    public function cancel(){

        $this->updateMode = true;
        $this->resetInputFields();
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable',
        ]);

        if($this->user_id){
            $user = User::findOrFail($this->user_id);
            $user->update([
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>$this->password
            ]);
            $this->updateMode = false;
            session()->flash('message', 'User Updated Successfully');
            $this->resetInputFields();
            $this->dispatch('userUpdate');
        }
    }

    public function delete($id){
        if($id){
            User::where('id', $id)->delete();
            session()->flash('message', 'User Deleted Successfully');
        }
    }


}
