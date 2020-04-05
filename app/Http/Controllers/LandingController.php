<?php

namespace App\Http\Controllers;

use App\Apprentice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite as Socialite;

use App\User;
use App\TechnicianInfo;
use App\ResidentialInfo;
use App\CommercialInfo;
use App\TechnicianTradeList;
use App\BlogPost;
use App\BlogTag;
use App\BlogComment;
use App\BlogCommentReply;
use App\Contact;

class LandingController extends Controller
{
  /**
   * Show the application dashboard.
   * if session is google redirect to google social login
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    /*
    * google login
    */
    if(session('session') == 'google'){
      return Socialite::driver('google')->redirect();
    }
    return view('source_file.Landing.homepage');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function about()
  {
      return view('source_file.Landing.about');
  }
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function listProject()
  {
      return view('source_file.Landing.list_project');
  }
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function customise()
  {
      return view('source_file.Landing.customise');
  }
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function customise_(Request $request)
  {
      $this->validate($request, [
      'name' => 'required|max:255',
      'description' => 'required',
      'location' => 'required',
      'email' => 'required|email|max:255',
      'contact' => 'required',
      'service' => 'required'
    ]);
    
    $name = $request->input('name');
    $email = $request->input('email');
    $contact = $request->input('contact');
    $description = $request->input('description');
    $location = $request->input('location');
    $service = $request->input('service');
      
      $project = DB::table('customise_services')->insert([
          'name' => $name,
          'email' => $email,
          'service' => $service,
          'contact' => $contact,
          'description' => $description,
          'location' => $location,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
          ]);
          
          return redirect('/customize')->with('status', 'Service Submitted');
  }
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function listProject_(Request $request)
  {
      $this->validate($request, [
      'name' => 'required|max:255',
      'description' => 'required',
      'location' => 'required',
      'email' => 'required|email|max:255',
      'contact' => 'required',
      'attachement' => 'required',
    ]);
    
    $name = $request->input('name');
    $email = $request->input('email');
    $contact = $request->input('contact');
    $description = $request->input('description');
    $location = $request->input('location');
    
    
    if($request->hasFile('attachement')){
        $attach = $request->file('attachement');
        $fileName1 = $attach->getClientOriginalName();
        $fileExt1 = $attach->getClientOriginalExtension();
        $filePath1 = pathinfo($fileName1, PATHINFO_FILENAME);
        $saveAs1 = $filePath1.'_'.time().'.'.$fileExt1;
        $path1 = $attach->move('storage/storage/', $saveAs1);
      }else{
        $saveAs1 = null;
      }
      
      $project = DB::table('project_lists')->insert([
          'name' => $name,
          'email' => $email,
          'contact' => $contact,
          'description' => $description,
          'location' => $location,
          'attachement' => $saveAs1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
          ]);
          
          return redirect('/project_listing')->with('status', 'Project Submitted');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function contact()
  {
      return view('source_file.Landing.contact');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function location($latitude, $longitude)
  {
    $result = array();
    $userResult = array();
    $location_query = "SELECT *, (3956 * 2 * ASIN(SQRT(POWER(SIN(($latitude - latitude) * pi()/180/2), 2) + COS($latitude * pi() /180) * COS(latitude * pi()/180) *
          POWER(SIN(($longitude - longitude) * pi()/180 / 2), 2)))) AS 'distance' FROM locations";

    $nearTechncian = DB::SELECT($location_query);

    foreach($nearTechncian as $location){
        if($location->distance <= 50){
            array_push($result, $location);
        }
    }

    foreach ($result as $result_) {
      $user_ = User::find($result_->user_id);
      if($user_->account_type == 1){
        $result_->name = $user_->name;
        $user_technician = TechnicianInfo::where('user_id', '=', $result_->user_id)->get();
        $user_technician_count = count($user_technician);
        if($user_technician_count == 1){
          $result_->location = $user_technician[0]->location;
        }else{
          $result_->location = '';
        }
        if($user_technician[0]->trade_type){
          $trade_type = TechnicianTradeList::find($user_technician[0]->trade_type);
          $result_->trade_name = $trade_type->trade_name;
        }else{
          $result_->trade = '';
        }
        array_push($userResult, $result_);
      }
    }
    return view('source_file.Landing.homepage_location')->with('userResult', $userResult);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function blogs()
  {
    $blog = BlogPost::join('blog_tags', 'blog_tags.id', '=', 'blog_posts.tag_id')->select('blog_posts.*', 'blog_tags.tag')->orderBy('id', 'DESC')->paginate(10);

    return view('source_file.Landing.blogs')->with('blog', $blog);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function blog($id)
  {
    $blog = BlogPost::find($id);
    $tag = BlogTag::find($blog->tag_id);
    $blog->tag = $tag->tag;

    $comment = BlogComment::where('post_id', '=', $id)->orderBy('id', 'DESC')->get();

    foreach($comment as $comment_){
      $user = User::find($comment_->commenter_id);
      $comment_->name = $user->name;

      switch ($user->account_type) {
        case 1:
         $technician = TechnicianInfo::where('user_id', '=', $user->id)->first();
         if($residential){
           $comment_->profile_image = $technician->profile_image;
         }else{
           $comment_->profile_image = 'profile_image.png';
         }
          break;
        case 2:
         $residential = ResidentialInfo::where('user_id', '=', $user->id)->first();
         if($residential){
           $comment_->profile_image = $residential->profile_image;
         }else{
           $comment_->profile_image = 'profile_image.png';
         }
          break;
        case 3:
         $commercial = CommercialInfo::where('user_id', '=', $user->id)->first();
         if($residential){
           $comment_->profile_image = $commercial->profile_image;
         }else{
           $comment_->profile_image = 'profile_image.png';
         }
          break;
      }

    }

    return view('source_file.Landing.blog')->with('blog', $blog)->with('comment', $comment);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function comment(Request $request)
  {
    $this->validate($request, [
      'id' => 'required',
      'comment' => 'required'
    ]);

    $blog_id = $request->input('id');
    $comment = $request->input('comment');

    $blog_comment = new BlogComment;
    $blog_comment->commenter_id = Auth::id();
    $blog_comment->post_id = $blog_id;
    $blog_comment->comment = $comment;
    $blog_comment->save();

    return redirect()->back();
  }
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function viewTechnician($id)
  {
      $technician = TechnicianInfo::where('trade_type', '=', $id)->paginate(10);
      
      
      foreach($technician as $tech){
          $tech_user = User::find($tech->user_id);
          $tech->name = $tech_user->name;
          $tech->email = $tech_user->email;
      }
      
      switch ($id) {
          case 1:
              $trade_type = "HVCA";
          break;
          case 2:
              $trade_type = "Electrical";
          break;
          case 3:
              $trade_type = "Plumbing";
          break;
          case 4:
              $trade_type = "Handy Pro";
          break;
          default:
              return redirect('/');
              break;
        
      }
      return view('source_file.Landing.technicianList')->with('technician', $technician)->with('trade_type', $trade_type); 
  }
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function viewContractor()
  {
      $technician = TechnicianInfo::where('trade_type', '=', null)->paginate(10);
      
      
      foreach($technician as $tech){
          $tech_user = User::find($tech->user_id);
          $tech->name = $tech_user->name;
          $tech->email = $tech_user->email;
      }
      
      $trade_type = 'Local Contractor';
      return view('source_file.Landing.technicianList')->with('technician', $technician)->with('trade_type', $trade_type); 
  }
  
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function allTechnician()
  {
      $technician = TechnicianInfo::where('trade_type', '!=', null)->paginate(10);
      
      
      foreach($technician as $tech){
          $tech_user = User::find($tech->user_id);
          $tech->name = $tech_user->name;
          $tech->email = $tech_user->email;
          switch ($tech->trade_type) {
          case 1:
              $tech->trade_type = "HVCA";
          break;
          case 2:
              $tech->trade_type = "Electrical";
          break;
          case 3:
              $tech->trade_type = "Plumbing";
          break;
          case 4:
              $tech->trade_type = "Handy Pro";
          break;
          default:
              return redirect('/');
              break;
        
      }
      }
      
      $trade_type = 'All Technician';
      
      return view('source_file.Landing.allTechnician')->with('technician', $technician)->with('trade_type', $trade_type); 
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function reply_comment(Request $request)
  {
    $id= Auth::id();
    $comment = $request->comment;
    $comment_id = $request->id;

    $BlogCommentReply = new BlogCommentReply;
    $BlogCommentReply->commenter_id = $id;
    $BlogCommentReply->comment = $comment;
    $BlogCommentReply->comment_id = $comment_id;
    $BlogCommentReply->save();

    $comment_reply = BlogCommentReply::where('comment_id', '=', $comment_id)->orderBy('id', 'DESC')->get();

    foreach($comment_reply as $comment_){
      $user = User::find($comment_->commenter_id);
      $comment_->name = $user->name;

      switch ($user->account_type) {
        case 1:
         $technician = TechnicianInfo::where('user_id', '=', $user->id)->first();
         if($residential){
           $comment_->profile_image = $technician->profile_image;
         }else{
           $comment_->profile_image = 'profile_image.png';
         }
          break;
        case 2:
         $residential = ResidentialInfo::where('user_id', '=', $user->id)->first();
         if($residential){
           $comment_->profile_image = $residential->profile_image;
         }else{
           $comment_->profile_image = 'profile_image.png';
         }
          break;
        case 3:
         $commercial = CommercialInfo::where('user_id', '=', $user->id)->first();
         if($residential){
           $comment_->profile_image = $commercial->profile_image;
         }else{
           $comment_->profile_image = 'profile_image.png';
         }
          break;
      }

    }
    return $comment_reply;
  }




  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function view_reply_comment(Request $request)
  {
    $comment_id = $request->id;

    $comment_reply = BlogCommentReply::where('comment_id', '=', $comment_id)->orderBy('id', 'DESC')->get();

    foreach($comment_reply as $comment_){
      $user = User::find($comment_->commenter_id);
      $comment_->name = $user->name;

      switch ($user->account_type) {
        case 1:
         $technician = TechnicianInfo::where('user_id', '=', $user->id)->first();
         if($residential){
           $comment_->profile_image = $technician->profile_image;
         }else{
           $comment_->profile_image = 'profile_image.png';
         }
          break;
        case 2:
         $residential = ResidentialInfo::where('user_id', '=', $user->id)->first();
         if($residential){
           $comment_->profile_image = $residential->profile_image;
         }else{
           $comment_->profile_image = 'profile_image.png';
         }
          break;
        case 3:
         $commercial = CommercialInfo::where('user_id', '=', $user->id)->first();
         if($residential){
           $comment_->profile_image = $commercial->profile_image;
         }else{
           $comment_->profile_image = 'profile_image.png';
         }
          break;
      }

    }
    return $comment_reply;
  }


  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function contactUs(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required',
      'subject' => 'required',
      'message' => 'required'
    ]);

    $contact = new Contact;
    $contact->name = $request->input('name');
    $contact->email = $request->input('email');
    $contact->subject = $request->input('subject');
    $contact->message = $request->input('message');
    $contact->save();

    return redirect()->back()->with('status', 'Message Sent');
  }



  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function apprentice()
  {
    return view('source_file.Landing.apprentice'); 
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function apprentice_(Request $request)
  {
    $this->validate($request, [
      'firstname' => 'required',
      'lastname' => 'required',
      'initialname' => 'required',
      'address' => 'required',
      'city' => 'required',
      'zip' => 'required',
      'phone' => 'required|digits:10',
      'email' => 'required',
      'studentId' => 'required',
      'highSchool' => 'required',
      'cityHighSchool' => 'required',
      'yearHighSchool' => 'required',
      'institute' => 'required',
      'city_' => 'required',
      'year_' => 'required',
      'certificate' => 'required',
      'institution' => 'required',
      'city__' => 'required',
      'year__' => 'required',
      'certificates' => 'required',
      'experience' => 'required',
      'objective' => 'required',
    ]);


    $firstName = $request->input('firstname');
    $lastName = $request->input('lastname');
    $initialName = $request->input('address');
    $address = $request->input('address');
    $city = $request->input('city');
    $zip = $request->input('zip');
    $phone = $request->input('phone');
    $email = $request->input('email');
    $studentId = $request->input('studentId');
    $highSchool = $request->input('highSchool');
    $cityHighSchool = $request->input('cityHighSchool');
    $yearHighSchool = $request->input('yearHighSchool');
    $institute = $request->input('institute');
    $city_ = $request->input('cit_');
    $year_ = $request->input('year_');
    $certificate = $request->input('certificate');
    $institution = $request->input('institution');
    $city__ = $request->input('city__');
    $year__ = $request->input('year');
    $certificates = $request->input('certificates');
    $experience = $request->input('experience');
    $objective = $request->input('objective');

    $apprentice = new Apprentice;
    $apprentice->firstName = $firstName;
    $apprentice->lastName = $lastName;
    $apprentice->initialName = $initialName;
    $apprentice->mailingAddress = $address;
    $apprentice->city = $city;
    $apprentice->zip = $zip;
    $apprentice->phone = $phone;
    $apprentice->email = $email;
    $apprentice->studentId = $studentId;
    $apprentice->highSchool = $highSchool;
    $apprentice->highSchoolCity = $cityHighSchool;
    $apprentice->highSchoolYear = $yearHighSchool;
    $apprentice->institue1 = $institute;
    $apprentice->instituteCity1 = $city_;
    $apprentice->instituteDate1 = $year_;
    $apprentice->certificate1 = $certificate;
    $apprentice->institute2 = $institution;
    $apprentice->instituteCity2 = $city__;
    $apprentice->instituteDate2 = $year__;
    $apprentice->certificate2 = $certificates; 
    $apprentice->experience = $experience;
    $apprentice->objective = $objective;
    $apprentice->save();
    
    return redirect()->back()->with('status', 'Application Submitted');
  }



}
