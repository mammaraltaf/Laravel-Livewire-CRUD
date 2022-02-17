<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;


class Students extends Component
{
    use WithPagination;
    public $ids;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $search;
    public $queryString = ['search'];

    public function render()
    {

        $students =Student::where('firstName','like','%'.$this->search.'%')->paginate(7);
//        $students = Student::orderBy('id','DESC')->paginate(7);
        return view('livewire.students',['students'=>$students]);
    }

    public function mount(){
        $this->resetInputFields();
    }
    public function resetInputFields(){
        $this->firstname='';
        $this->lastname='';
        $this->email='';
        $this->phone='';
    }

    protected $rules = [
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'phone' => 'required|digits:11',
        'email' => 'required|email',
    ];

    public function store(){
        $validateData=$this->validate();
        Student::create($validateData);
        $this->resetInputFields();
        session()->flash('message','Student Created Successfully!');
//        Alert::success('Success', 'Data Inserted Successfully!');

        $this->emit('studentAdded');
    }
    public function edit($id){
        $student = Student::where('id',$id)->first();
        $this->ids = $student -> id;
        $this->firstname = $student -> firstname;
        $this->lastname = $student -> lastname;
        $this->email = $student -> email;
        $this->phone = $student -> phone;
    }

    public function update(){
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        if($this->ids){
            $student = Student::find($this->ids);
            $student->update([
                'firstname'=>$this->firstname,
                'lastname'=>$this->lastname,
                'email'=>$this->email,
                'phone'=>$this->phone,
            ]);
            $this->resetInputFields();
            session()->flash('message','Student updated Successfully!');
            $this->emit('studentUpdated');
        }
    }

    public function delete($id){
        if($id){
            Student::where('id',$id)->delete();
            session()->flash('message','Student Deleted Successfully!');
        }
    }

}
