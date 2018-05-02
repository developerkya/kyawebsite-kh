<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use Excel;
class MembershipController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    // index
    public function index()
    {
        $data['memberships'] = DB::table('memberships')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(18);
        return view('memberships.index', $data);
    }
    public function save(Request $r) 
    {
        $data = array(
            'english_first_name' => $r->english_first_name,
            'english_family_name' => $r->english_family_name,
            'khmer_first_name' => $r->khmer_first_name,
            'khmer_family_name' => $r->khmer_family_name,
            'date_of_birth' => $r->date_of_birth,
            'place_of_birth' => $r->place_of_birth,
            'current_address' => $r->current_address,
            'gender' => $r->gender,
            'phone' => $r->phone,
            'email' => $r->email,
            'receive_newsletter' => $r->receive_newsletter,
            'social_url' => $r->social_url
        );
        
        $sms = "The new membership has been created successfully.";
        $sms1 = "Fail to create the new membership, please check again!";
        $i = DB::table('memberships')->insertGetId($data);

        if ($i)
        {
            if($r->photo) {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $destinationPath = 'public/uploads/members';
                $file->move($destinationPath, $i.$file_name);
    
                $data['photo'] = $i.$file_name;
                DB::table('memberships')->update($data);
            }
            // add to newsletter
            if($r->receive_newsletter=='yes')
            {
                $d = array(
                    'name' => $r->english_first_name. ' '. $r->english_last_name,
                    'email' => $r->email
                );
                $counter = DB::table('newsletters')->where('active',1)->where('email',$r->email)->count();
                if($counter<=0)
                {
                    DB::table('newsletters')->insert($d);
                }
            }
            $r->session()->flash('sms', $sms);
            return redirect('/membership/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/membership/create')->withInput();
        }
    }
     // load create form
     public function create()
     {
         return view('memberships.create');
     }
    
     public function edit($id)
     {
         $data['membership'] = DB::table('memberships')
             ->where('id',$id)->first();
         return view('memberships.edit', $data);
     }
     // delete
     public function delete($id)
     {
         DB::table('memberships')->where('id', $id)->update(['active'=>0]);
         return redirect('/membership');
     }
     public function update(Request $r)
     { 
        $data = array(
            'english_first_name' => $r->english_first_name,
            'english_family_name' => $r->english_family_name,
            'khmer_first_name' => $r->khmer_first_name,
            'khmer_family_name' => $r->khmer_family_name,
            'date_of_birth' => $r->date_of_birth,
            'place_of_birth' => $r->place_of_birth,
            'current_address' => $r->current_address,
            'gender' => $r->gender,
            'phone' => $r->phone,
            'email' => $r->email,
            'receive_newsletter' => $r->receive_newsletter,
            'social_url' => $r->social_url
        );
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'public/uploads/members';
            $file->move($destinationPath, $r->id.$file_name);

            $data['photo'] = $r->id.$file_name;
        }
         $sms = "All changes have been saved successfully.";
         $sms1 = "Fail to to save changes, please check again!";
         $i = DB::table('memberships')->where('id', $r->id)->update($data);
         if ($i)
         {
             // add to newsletter
            if($r->receive_newsletter=='yes')
            {
                $d = array(
                    'name' => $r->english_first_name. ' '. $r->english_last_name,
                    'email' => $r->email
                );
                $counter = DB::table('newsletters')->where('active',1)->where('email',$r->email)->count();
                if($counter<=0)
                {
                    DB::table('newsletters')->insert($d);
                }
            }
             $r->session()->flash('sms', $sms);
             return redirect('/membership/edit/'.$r->id);
         }
         else
         {
             $r->session()->flash('sms1', $sms1);
             return redirect('/membership/edit/'.$r->id);
         }
     }
     // view detail
     public function detail($id) 
     {
         $data['membership'] = DB::table('memberships')
             ->where('id',$id)->first();
         return view('memberships.detail', $data);
     }
     public function export_excel()
     {
        
         Excel::create('Memberships', function($excel) {
 
             $excel->sheet('Sheet 1', function($sheet) {
     
                 $memberships=DB::table('memberships')->select(
                     "khmer_first_name",
                     'khmer_family_name',
                     'english_first_name',
                     'english_family_name',
                     'date_of_birth',
                     'place_of_birth',
                     'current_address',
                     'gender',
                     'phone',
                     'email',
                     'receive_newsletter'
                     )->where('active',1)
                     ->get();
                      $i = 1;
                     foreach($memberships as $membership) {
                      $data[] = array(
                         $i++,
                         $membership->khmer_first_name,
                         $membership->khmer_family_name,
                         $membership->english_first_name,
                         $membership->english_family_name,
                         $membership->date_of_birth,
                         $membership->place_of_birth,
                         $membership->current_address,
                         $membership->gender,
                         $membership->phone,
                         $membership->email,
                         $membership->receive_newsletter
                     );
                 }
                 $sheet->fromArray($data, null, 'A1', false, false);
                 $headings = array('ID','Khmer First Name', 'Khmer Family Name', 'English First Name', 'English Family Name', 'Date of Birth', 'Place of Birth', 'Current Address', 'Gender', 'Phone', 'Email', 'Reveive Newslatter');
                 $sheet->prependRow(1, $headings);
             });
         })->export('xls');
     }
}
