@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Terms & Condition')

<style>
   .stitle {
    font-size: 20px;
}
p{
    color:#000;
    margin-bottom:20px;
    text-align: justify
}
.ultag{
        color: #000;
    list-style: circle;
    padding-left: 35px !important;
    display: grid;
    gap: 12px;
}
.ultag li{
    text-align: justify; 
}

@media screen and (min-width: 1280px) {
    .container-m {
        max-width: 1200px;
    }
}

</style>

<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Terms and Conditions</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container-m">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="javascripti:void(0)">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Terms and Conditions
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="container">
        <h2 class="title">Terms and Conditions</h2>
        <!-- End .title -->
        
        <h4 class="stitle">Acceptance of terms:</h4>
        
        <p style="text-align: justify">
           EcoHabitat Tech Solutions Pvt. Ltd. (“Your Rent Hub”) provides its services to you, subject to the terms and conditions are given hereunder. By visiting this website (<a href="/"><b>www.yourrenthub.com</b></a> and all its subdomains) you agree to be bound by the terms and conditions of this Policy. If you do not agree please do not use or access our Site.
        </p>
        
        <p style="text-align: justify">
            <b>Note -</b> Our privacy policy is subject to change at any time without notice. To make sure you are aware of any changes, please review this policy periodically.
This site is created and controlled by Your Rent Hub. The laws of India shall apply and courts in Pune shall have jurisdiction in respect of all the terms, conditions and disclaimers.

        </p>
        
         <h4 class="stitle">AMENDMENTS / MODIFICATIONS</h4>
         
         <p style="text-align: justify">
             <b>Your Rent Hub</b> reserves the right to change the particulars contained in the Agreement from time to time and at any time. If Your Rent Hub decides to make changes to the Agreement, it will post the new version on the website and update the date specified above or communicate the same to you by other means. Any change or modification to the Agreement will be effective immediately from the date of upload of the Agreement on the Platform. It is pertinent that you review the Agreement whenever we modify them and keep yourself updated about the latest terms of Agreement because if you continue to use the Your Rent Hub after we have posted modified Agreement, you are indicating to us that you agree to be bound by the modified Agreement. If you don’t agree to be bound by the modified terms of the Agreement, then you may not use the Your Rent Hub anymore.
         </p>
         
            <h4 class="stitle">YOUR RENT HUB</h4>
        
        
        <p style="text-align: justify">
           Your Rent Hub is a marketplace feature of the Platform more particularly described below. that helps owners of vehicles (“Hosts”) connect with users in temporary need of a bicycle on leasehold basis (“Guest”) for their personal use (“Your Rent Hub”). Your Rent Hub does not itself lease or deal with such products in any manner whatsoever and only provides a service connecting the Hosts to the Guests so they may enter into a Lease Agreement (defined below). You understand and agree that Your Rent Hub is not a party to the Lease Agreement entered into between you as the Host of the vehicle or you as the Guest of the vehicle, nor is Your Rent Hub a transportation service, agent, or insurer. Your Rent Hub has no control over the conduct of the Users of the Your Rent Hub and disclaims all liability in this regard.
Your Rent Hub aims to establish and provide a robust marketplace of reliable Hosts and Guests. Although Your Rent Hub provides support for the transaction between Hosts and Guests, we do not guarantee the quality or safety of the bicycles listed on the Platform, nor can we guarantee the truth or accuracy of any listings, or whether Hosts and Guests will consummate a transaction, including the completion of any payment obligations.

        </p>
        
         <h4 class="stitle">USE OF YOUR RENT HUB</h4>
         
         <p>
             While you may use some section/features of the Platform without registering with us, to access Your Rent Hub you will be required to register and create an account with us and verify yourself by Government’s Aadhar Verification. Thereafter, only the Hosts and Guests satisfying the applicable eligibility criteria (listed below) will be able to use the services subject to the terms and conditions of this Agreement.
         </p>
         
          <h4 class="stitle">Definitions:</h4>
          
          <ul class="ultag">
              <li><b>Agreement</b> - means the Terms and Conditions (T&C) contained herein under the <b>Your Rent Hub</b> brand name. It will also include references to this Agreement as and when amended, notated, supplemented, varied or replaced.</li>
              <li>
                  <b>Platform</b> - means <a href="/"><b>www.yourrenthub.com</b></a> (and all its subdomains), owned and operated by Your Rent Hub, which provides a venue to users to buy the products listed/displayed
              </li>
              
               <li>
                  <b>User/You</b> - The terms "User," "Customer," "You," and "Your" means the individual or entity that accesses our website, mobile application, or services. 
              </li>
              
               <li><b>Services</b> - The term "Services" means the bicycle rental services, offered by Your Rent Hub through its Platform.
              </li>
          </ul>
          
          <h4 class="stitle">Eligibility Criteria</h4>
          <h4 class="stitle">Host</h4>
          
        <ul class="ultag">
              <li>The User certifies that he/she is at least 18 (eighteen) years of age or has the consent of a parent or legal guardian.</li>
              <li>The User must have valid Aadhar number and/or other form of government issued identification document.</li>
              
               <li>Your vehicle must be clean, well maintained and have the basic accessories, including safety lock as per our maintenance, component and safety standards.</li>
              
               <li>You must provide valid identity and address proof original / picture of identity document in compliance with KYC norms under the Prevention of Money Laundering Act, 2002.
              </li>
          </ul>
          
          <h4 class="stitle">Guest</h4>
          
            <ul class="ultag">
              <li>The User certifies that he/she is at least 18 (eighteen) years of age or has the consent of a parent or legal guardian.</li>
              
               <li>The User must have valid Aadhar number and/or other form of government issued identification document.</li>
              
               <li>You must provide valid identity and address proof original / picture of identity document in compliance with KYC norms under the Prevention of Money Laundering Act, 2002.
              </li>
          </ul>
          
           <h4 class="stitle">Vendor</h4>
           
            <ul class="ultag">
              <li>The User certifies that he/she is at least 18 (eighteen) years of age</li>
              
               <li>The User must have valid Aadhar number and/or other form of government issued identification document.</li>
              
               <li>The user must do bicycle service and maintenance.</li>
               <li>Your vehicle must be clean, well maintained and have the basic accessories, including safety lock as per our maintenance, component and safety standards.</li>
          </ul>
          
          <h4 class="stitle">Auditor</h4>
          
           <ul class="ultag">
              <li>The User certifies that he/she is at least 18 (eighteen) years of age</li>
              
               <li>The User must have valid Aadhar number and/or other form of government issued identification document.</li>
              
               <li>The User must have a running business of bicycles</li>
               <li>The User must have a GST number for the business.</li>
               <li>The User must provide proper bicycle service and maintenance</li>
          </ul>
          
           <h4 class="stitle">Creating account</h4>
           
            <ul class="ultag">
              <li>To access and use the Your Rent Hub Services, you shall have to open an account on the Platform with a valid email address by providing certain complete and accurate information and documentation including but not limited to your name, date of birth, an email address and password, and other identifying information as may be necessary to open the account on the Platform. Each user may open and maintain only one account on the Platform.</li>
              
        <li>Please see below an indicative list of documents that you will be required to submit as part of the registration process on the Platform. Your Rent Hub may on a need basis request submission of additional documents as well, as it may deem necessary for facilitation of Your Rent Hub Services.</li>
        
        <li><b>For Host:</b></li>
        
          </ul>
        
        <ul  class="ultag">
            <li>Valid Government ID Card (Aadhar, Voter’s ID, Passport etc)</li>
            <li>Current Address Proof. (Rent Agreement/Company Allotment Letter etc.)</li>
            <li>Purchase Bill of the bicycle</li>
              <li><b>For Guest:</b></li>
        </ul>
        
        
           <ul  class="ultag">
            <li>Valid Government ID Card (Aadhar, Voter’s ID, Passport etc)</li>
            <li>Current Address Proof. (Rent Agreement/Company Allotment Letter etc.)</li>
            <li><b>For Vendor:</b></li>
            <li>Valid Government ID Card (Aadhar, Voter’s ID, Passport etc)</li>
            <li>Current Address Proof. (Rent Agreement/Company Allotment Letter etc.)</li>
            <li>Current Address Proof. (Rent Agreement/Company Allotment Letter etc.)</li>
            <li>GST certificate (For Business reasons)</li>
            <li>Purchase Bill of the bicycle</li>
            <li><b>For Auditor:</b></li>
            <li>Valid Government ID Card (Aadhar, Voter’s ID, Passport etc)</li>
            <li>Current Address Proof. (Rent Agreement/Company Allotment Letter etc.)</li>
            <li>GST certificate (For Business reasons)</li>
            <li>By registering on the Platform, each applicant i.e., the Host, Guest, Vendor and the Auditor authorizes Your Rent Hub and <b>Your Rent Hub</b> reserves the right, in its sole discretion, to verify the documents submitted by such applicant through the Platform. <b>Your Rent Hub</b> may in its sole discretion use third-party services to verify the information you provide to us and to obtain additional related information and corrections where applicable, and you hereby authorize <b>Your Rent Hub</b> to request, receive, use, and store such information in accordance with our Privacy Policy. Further, <b>Your Rent Hub</b> reserves the right, at its sole discretion, to suspend or terminate the <b>Your Rent Hub</b> Services to any of the registered users while their account is still active for any reason whatsoever. <b>Your Rent Hub</b> may provide any information necessary to the Hosts, insurance companies, or law enforcement authorities to assist in the filing of a stolen bicycle claim, insurance claim, or legal action.</li>
                 
        </ul>
        
        <h4 class="stitle">On boarding vehicle</h4>
        
        <ul  class="ultag">
            <li>Once the user account is created, Hosts and Vendors can on-board and list their bicycle(s) on the Platform for leasing.</li>
            <li>The bicycle must be in working condition</li>
            <li>The vehicle shall be parked at Host’s own location</li>
            <li>If a Designated Location has restricted access, Host shall ensure that guest is able to access the location for a booking to make the pickup process seamless. </li>
        </ul>
        <h4 class="stitle">Online Booking Process</h4>
        
          
           <ul  class="ultag">
            <li>Once the user has uploaded the vehicle, guest can book the vehicle through the platform subject to availability</li>
            <li>The booking is confirmed once complete payment of the booking amount is done</li>
            <li>Guest can do payment through various methods as specified on the platform including credit/debit card, UPI, wallet</li>
            <li>Rental charges are as per the rates displayed on the platform at the time of the booking. The rental charges vary based on duration and vehicle type</li>
            <li>
                A refundable security deposit is collected at the time of vehicle booking. The amount is decided by the vehicle owner. amount may vary based on the bicycle type and will be clearly communicated during the booking process. A proper receipt for the security deposit will be provided. This security deposit can be used in case of disputes.
            </li>
        </ul>
        
        <h4 class="stitle">Offline Booking Program</h4>
        
          
           <ul  class="ultag">
            <li>Any instances where the Host and the Guest enter into a rental or similar program involving the hiring, renting of the listed vehicle (by whatever name called) with an intention to bypass the Platform, such Offline program are not permitted for bicycles listed on the Platform.</li>
            <li>If any such offer to lease a listed vehicle outside the Platform, is made to/by either Parties (Host or the Guest), the same should be reported to Your Rent Hub immediately.</li>
            <li>Guest can do payment through various methods as specified on the platform including credit/debit card, UPI, wallet</li>
            <li>If you fail to follow these requirements, you may be subject to limit your access to Your Rent Hub and other services, restrictions on listings and suspension of your account.</li>
            <li>
               In case of offline programs, Your Rent Hub shall in no case be held liable for any damages (direct or indirect), consequential losses, loss of profit/business as faced by Host or the Guest.
            </li>
        </ul>
        
        
        <h4 class="stitle">Modification and Extension of booking</h4>

<ul class="ultag">
    <li>Booking can be modified 24 hrs before the pickup, subject to availability and modification fees is applicable</li>
    <li>Extension request can be made 24 hrs before the drop off, subject to availability and charges for the extended days need to be paid</li>
</ul>

<h4 class="stitle">Cancellation and Refund of booking</h4>

<ul class="ultag">
    <li>
        Cancellation can be done and following is the refund amount
        <ul>
            <li>Cancellation made 2 days before pickup time: 80% refund</li>
            <li>Cancellation made between 1 to 2 days before pickup time: 50% refund</li>
            <li>Cancellation made less than 1 day before pickup time: no refund</li>
        </ul>
    </li>
    <li>If the user does not turn up for pickup: no refund</li>
    <li>If Your Rent Hub is unable to provide the bicycle due to unforeseen circumstances, a 100% refund will be done.</li>
    <li>If the vehicle is not in working condition of use, a 100% refund will be done.</li>
    <li>Refund will be processed within 5-7 working days</li>
</ul>



<h4 class="stitle">Vehicle Pickup</h4>

<ul class="ultag">
    <li>Guest must arrive at the designated pickup location at least 15 minutes before the scheduled time for documentation and formalities.</li>
    <li>Host shall keep the vehicle clean and routine maintenance of fitting and filling air pressure.</li>
    <li>As a guest, you are entitled and encouraged to inspect and test drive the vehicle before accepting it. Any existing damages or issues must be reported to our representative and documented before leaving the rental location.</li>
    <li>You must record any pre-existing damage by taking photographs before starting your trip.</li>
</ul>

<h4 class="stitle">Usage Terms</h4>

<ul class="ultag">
    <li>Use the bicycle thinking it is yours only</li>
    <li>The renter remains fully responsible for the vehicle regardless of who is driving at any given time, as per the principle of vicarious liability under Indian law.</li>
    <li>
        The vehicle shall not be used for any
        <ul>
            <li>illegal purpose</li>
            <li>for carrying goods/commercial purposes</li>
            <li>for stunts (until specifically specified)</li>
            <li>for carrying hazardous, explosive or inflammable materials</li>
        </ul>
    </li>
    <li>The renter must comply with the traffic rules</li>
</ul>

      <h4 class="stitle">Vehicle Return</h4>

<ul class="ultag">
    <li>The vehicle must be returned to the designated location</li>
    <li>The vehicle must be returned at the scheduled time, early returns do not qualify for refunds, late returns will have penalties</li>
    <li>Guest shall get the vehicle cleaned before handing it over to the Host</li>
    <li>The vehicle must be returned in the same condition as it was given</li>
    <li>After clearing inspection by the host, the security deposit will be returned at the earliest.</li>
    <li>The vehicle must not be abandoned else it will result in penalties.</li>
</ul>
  
  
  <h4 class="stitle">Fees</h4>

<ul class="ultag">
    <li><strong>Listing Fees:</strong> Your rent hub shall be entitled to charge the host a fee for listing their products on Your Rent Hub platform. The listing fees shall be deducted on yearly basis at the beginning</li>
    <li><strong>Facilitation fees:</strong> Your rent hub shall be entitled to charge the host a fee for the rental. The facilitation fees are calculated as a certain percentage of the rental. This fees will be deducted at the time of host pay-out.</li>
    <li><strong>Rental:</strong> Guest is liable to deposit full rental for the duration the bicycle is booked for. The rent is varies based on duration, vehicle type. The payments have to be made through the Your Rent Hub platform</li>
    <li><strong>Security Deposit:</strong> Guest shall deposit a refundable security deposit along with full rental for the duration the bicycle is booked for</li>
    <li>
        <strong>Host Pay-out:</strong> The Host shall be paid on the basis of bookings made and shall receive the Rental paid by the Guest booking period. The same shall be remitted to the Host, post deduction of any Facilitation Fee, charges for any add-on services (if availed by Host), and applicable taxes (if any).<br>
        The Pay-out Cycle for remitting such Rental to the Host shall be on a biweekly weekly basis or end of rental period (whichever is earlier) and amounts for the previous week (ending on Sunday) shall be credited to Host’s account on the next Saturday.
    </li>
    <li>
        <strong>Additional payments:</strong> Other than Rental and Security deposit, Guest is liable as per the fee policy
        <ul>
            <li>Late payment charges, is case of delays</li>
            <li>Add on service if availed</li>
            <li>Charges for cancellation, rescheduling, extension of booking as per fee policy</li>
            <li>Charges for loss of lock/key(s), accessories etc.</li>
        </ul>
    </li>
</ul>

<h4 class="stitle">Maintenance</h4>

<ul class="ultag">
    <li>To keep your bicycle in a healthy condition, a regular check-up and service (if needed) is necessary, it avoids issues like breakdown or malfunction while riding and avoid inconvenience to the guest while on rental.</li>
    <li>A regular service plan is designed to maintain your bicycle.</li>
    <li>While the bicycle is listed on the platform, the host shall follow the plan.</li>
    <li>This is to avoid any inconvenience to the guest and even for the host while riding it personally</li>
    <li>The bicycle shall be checked by the auditor once a year of listing or upon completion of 100 rental days, whichever is earlier</li>
    <li>The 100 rental days are calculated when the bicycle is given out on rent, while personal ride days are not included in it. These 100 days can vary from 3 months to 6 months or even a year</li>
    <li>In 100 rental days, it assures that bicycle gets used and will need a check-up.</li>
    <li>The platform will notify about the needed check-up to the host and guests who is looking bike for rent.</li>
    <li>Upon notification, host shall get the bicycle checked by the auditor</li>
    <li>Auditors takes care of the bicycle by through checking and servicing it based on the required action.</li>
    <li>Auditor will update the last check-up date on the platform marking the bicycle good to ride.</li>
    <li>Regular maintenance: Host shall do regular maintenance of the bicycle, if scheduled maintenance is due during the rental period, guest shall be notified at the time of pickup</li>
</ul>


<h4 class="stitle">Accidents and Other Damages</h4>

<ul class="ultag">
    <li>In the case of accident, you must lodge an FIR at the nearest police station</li>
    <li>Inform Your Rent Hub support at the earliest, through call or email</li>
    <li>Take photographs of the incident and accident scene</li>
    <li>All damages will be assessed by the auditors and/or Your Rent Hub representatives</li>
    <li>All charges of the damage will have to be bared by the guest</li>
    <li>Loss of rental days have to be bared by the Guest</li>
</ul>

        <hr class="mt-4 mb-4" />
    </div>
</main>
@endsection
