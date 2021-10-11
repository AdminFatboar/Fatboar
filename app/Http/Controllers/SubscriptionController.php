<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Newsletter\NewsletterFacade;
use Newsletter;
use Illuminate\Support\Facades\Validator;



class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
      // validation données côté back
      $validator = Validator::make($request->all(), [
          'email' => 'required|email',
      ]);
      if($validator->fails()){
        // fail si requête ne correspond pas à validation
        return back()->with($validator);
      }
      
      
      if (NewsletterFacade::isSubscribed($request->email) ) {
        //envoie d'erreur, déjà souscrit
        return back()->with('failure', 'Vous êtes déjà inscrit à notre newsletter !')->withInput(['tab'=>'pills-newsletter']);
  
      }
  
      // Store name and email in Mailchimp
      Newsletter::subscribe($request->email);
      // Add tags to subscriber
      Newsletter::addTags(['website'], $request->email);
      //include success message
      return back()->with('good', 'Félicitations ! Vous venez de vous inscrire à notre newsletter.')->withInput(['tab'=>'pills-newsletter']);

  
    }

}
