<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Bootstrap icon--> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/defaultStyle.css">

    <!--Google API (GSI)-->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!--My CSS and JS-->
    <!--link type="text/css" rel="stylesheet" href="../css/signup.css"/-->
    <!--script src="../javascript/index.js"></script-->
    <style>
label{
    font-size: 12px;
    color: #234471;
}

.containerForm{
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height: max-content;
    width: max-content;
    padding: 20px;
    text-align: center;
    border-radius: 15px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    
}


.form-control{
    border: 0;
}


@media screen and (max-height: 850px) {

.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    height: max-content;
    width: max-content;
    padding: 15px;
    text-align: center;
    border-radius: 15px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
}

@media screen and (max-width: 650px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 35%;
    left: 50%;
    transform: translateX(-50%) translateY(-35%);
    height: 750px;
    width: 385px;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

/* S20 Ultra and iphone6/7/8 Plus*/
@media screen and (max-width: 450px) {
    body{  
    background-color: #f1f1f1;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translateX(-50%) translateY(-40%);
    height: 700px;
    width: 385px;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

/* S8+ */
@media screen and (max-width: 360px) {
    body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 35%;
    left: 50%;
    transform: translateX(-50%) translateY(-35%);
    height: 890px;
    width: 350px;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}
}

/* S9 */
@media screen and (max-width: 320px) {
body{  
    background-color: #f1f1f1;
    font-family: "Bahnschrift", Times, serif;
}
.containerForm {
    background-color: #f1f1f1; /* Fallback color */
    color: black;
    font-weight: bold;
    position: absolute;
    top: 25%;
    left: 50%;
    transform: translateX(-50%) translateY(-25%);
    height: 750px;
    width: 300px;
    padding: 5px;
    text-align: center;
    border-radius: 0px;
    box-shadow: none;
}

footer * {
    font-size: 17px;
}

}

    </style>
    <link rel="icon" href="../asset/appIcon.png">
    <title>Uncluttered - Terms and Conditions</title>
</head>
<body>
    <script>
        
        const url = new URL(window.location.href);
    </script>
    
    <!-- Image and text Header-->
    <nav class="navbar navbar-light" style="background-color: #6E85B7;">
        <a class="navbar-brand" href="#" style="font-weight:bold; color: whitesmoke; text-shadow: 1px 1px #1C1C1C; font-size:25px">
            <img src="../asset/appIcon.png" width="40" height="40" class="d-inline-block align-top" alt="">
            Uncluttered
        </a>
    </nav>
     <div class="container">
        <div class="row mx-auto">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 mt-1 pt-2">
                            
                <h2 style="text-align: center;"><b>TERMS AND CONDITIONS</b></h2>
                <p>Last updated: 2022-12-01</p>
                <p>1. <b>Introduction</b></p>
                <p>Welcome to <b>Uncluttered</b> (“Company”, “we”, “our”, “us”)!</p>
                <p>These Terms of Service (“Terms”, “Terms of Service”) govern your use of our website located at <b>https://uncluterredapp.000webhostapp.com/</b> (together or individually “Service”) operated by <b>Uncluttered</b>.</p>
                <p>Our Privacy Policy also governs your use of our Service and explains how we collect, safeguard and disclose information that results from your use of our web pages.</p>
                <p>Your agreement with us includes these Terms and our Privacy Policy (“Agreements”). You acknowledge that you have read and understood Agreements, and agree to be bound of them.</p>
                <p>If you do not agree with (or cannot comply with) Agreements, then you may not use the Service, but please let us know by emailing at <b>uncluttered.webapp@gmail.com</b> so we can try to find a solution. These Terms apply to all visitors, users and others who wish to access or use Service.</p>
                <p>2. <b>Communications</b></p>
                <p>By using our Service, you agree to subscribe to newsletters, marketing or promotional materials and other information we may send. However, you may opt out of receiving any, or all, of these communications from us by following the unsubscribe link or by emailing at uncluttered.webapp@gmail.com.</p>

                <p>3. <b>Contests, Sweepstakes and Promotions</b></p>
                <p>Any contests, sweepstakes or other promotions (collectively, “Promotions”) made available through Service may be governed by rules that are separate from these Terms of Service. If you participate in any Promotions, please review the applicable rules as well as our Privacy Policy. If the rules for a Promotion conflict with these Terms of Service, Promotion rules will apply.</p>


                <p>4. <b>Content</b></p><p>Our Service allows you to post, link, store, share and otherwise make available certain information, text, graphics, videos, or other material (“Content”). You are responsible for Content that you post on or through Service, including its legality, reliability, and appropriateness.</p><p>By posting Content on or through Service, You represent and warrant that: (i) Content is yours (you own it) and/or you have the right to use it and the right to grant us the rights and license as provided in these Terms, and (ii) that the posting of your Content on or through Service does not violate the privacy rights, publicity rights, copyrights, contract rights or any other rights of any person or entity. We reserve the right to terminate the account of anyone found to be infringing on a copyright.</p><p>You retain any and all of your rights to any Content you submit, post or display on or through Service and you are responsible for protecting those rights. We take no responsibility and assume no liability for Content you or any third party posts on or through Service. However, by posting Content using Service you grant us the right and license to use, modify, publicly perform, publicly display, reproduce, and distribute such Content on and through Service. You agree that this license includes the right for us to make your Content available to other users of Service, who may also use your Content subject to these Terms.</p><p>Uncluttered has the right but not the obligation to monitor and edit all Content provided by users.</p><p>In addition, Content found on or through this Service are the property of Uncluttered or used with permission. You may not distribute, modify, transmit, reuse, download, repost, copy, or use said Content, whether in whole or in part, for commercial purposes or for personal gain, without express advance written permission from us.</p>
                <p>5. <b>Prohibited Uses</b></p>
                <p>You may use Service only for lawful purposes and in accordance with Terms. You agree not to use Service:</p>
                <p>0.1. In any way that violates any applicable national or international law or regulation.</p>
                <p>0.2. For the purpose of exploiting, harming, or attempting to exploit or harm minors in any way by exposing them to inappropriate content or otherwise.</p>
                <p>0.3. To transmit, or procure the sending of, any advertising or promotional material, including any “junk mail”, “chain letter,” “spam,” or any other similar solicitation.</p>
                <p>0.4. To impersonate or attempt to impersonate Company, a Company employee, another user, or any other person or entity.</p>
                <p>0.5. In any way that infringes upon the rights of others, or in any way is illegal, threatening, fraudulent, or harmful, or in connection with any unlawful, illegal, fraudulent, or harmful purpose or activity.</p>
                <p>0.6. To engage in any other conduct that restricts or inhibits anyone’s use or enjoyment of Service, or which, as determined by us, may harm or offend Company or users of Service or expose them to liability.</p>
                <p>Additionally, you agree not to:</p>
                <p>0.1. Use Service in any manner that could disable, overburden, damage, or impair Service or interfere with any other party’s use of Service, including their ability to engage in real time activities through Service.</p>
                <p>0.2. Use any robot, spider, or other automatic device, process, or means to access Service for any purpose, including monitoring or copying any of the material on Service.</p>
                <p>0.3. Use any manual process to monitor or copy any of the material on Service or for any other unauthorized purpose without our prior written consent.</p>
                <p>0.4. Use any device, software, or routine that interferes with the proper working of Service.</p>
                <p>0.5. Introduce any viruses, trojan horses, worms, logic bombs, or other material which is malicious or technologically harmful.</p>
                <p>0.6. Attempt to gain unauthorized access to, interfere with, damage, or disrupt any parts of Service, the server on which Service is stored, or any server, computer, or database connected to Service.</p>
                <p>0.7. Attack Service via a denial-of-service attack or a distributed denial-of-service attack.</p>
                <p>0.8. Take any action that may damage or falsify Company rating.</p>
                <p>0.9. Otherwise attempt to interfere with the proper working of Service.</p>
                <p>6. <b>Analytics</b></p>
                <p>We may use third-party Service Providers to monitor and analyze the use of our Service.</p>
                <p>7. <b>No Use By Minors</b></p>
                <p>Service is intended only for access and use by individuals at least eighteen (18) years old. By accessing or using Service, you warrant and represent that you are at least eighteen (18) years of age and with the full authority, right, and capacity to enter into this agreement and abide by all of the terms and conditions of Terms. If you are not at least eighteen (18) years old, you are prohibited from both the access and usage of Service.</p>
                <p>8. <b>Accounts</b></p><p>When you create an account with us, you guarantee that you are above the age of 18, and that the information you provide us is accurate, complete, and current at all times. Inaccurate, incomplete, or obsolete information may result in the immediate termination of your account on Service.</p><p>You are responsible for maintaining the confidentiality of your account and password, including but not limited to the restriction of access to your computer and/or account. You agree to accept responsibility for any and all activities or actions that occur under your account and/or password, whether your password is with our Service or a third-party service. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p><p>You may not use as a username the name of another person or entity or that is not lawfully available for use, a name or trademark that is subject to any rights of another person or entity other than you, without appropriate authorization. You may not use as a username any name that is offensive, vulgar or obscene.</p><p>We reserve the right to refuse service, terminate accounts, remove or edit content, or cancel orders in our sole discretion.</p>
                <p>9. <b>Intellectual Property</b></p>
                <p>Service and its original content (excluding Content provided by users), features and functionality are and will remain the exclusive property of Uncluttered and its licensors. Service is protected by copyright, trademark, and other laws of  and foreign countries. Our trademarks may not be used in connection with any product or service without the prior written consent of Uncluttered.</p>
                <p>10. <b>Copyright Policy</b></p>
                <p>We respect the intellectual property rights of others. It is our policy to respond to any claim that Content posted on Service infringes on the copyright or other intellectual property rights (“Infringement”) of any person or entity.</p>
                <p>If you are a copyright owner, or authorized on behalf of one, and you believe that the copyrighted work has been copied in a way that constitutes copyright infringement, please submit your claim via email to uncluttered.webapp@gmail.com, with the subject line: “Copyright Infringement” and include in your claim a detailed description of the alleged Infringement as detailed below, under “DMCA Notice and Procedure for Copyright Infringement Claims”</p>
                <p>You may be held accountable for damages (including costs and attorneys’ fees) for misrepresentation or bad-faith claims on the infringement of any Content found on and/or through Service on your copyright.</p>
                <p>11. <b>DMCA Notice and Procedure for Copyright Infringement Claims</b></p>
                <p>You may submit a notification pursuant to the Digital Millennium Copyright Act (DMCA) by providing our Copyright Agent with the following information in writing (see 17 U.S.C 512(c)(3) for further detail):</p>
                <p>0.1. an electronic or physical signature of the person authorized to act on behalf of the owner of the copyright’s interest;</p>
                <p>0.2. a description of the copyrighted work that you claim has been infringed, including the URL (i.e., web page address) of the location where the copyrighted work exists or a copy of the copyrighted work;</p>
                <p>0.3. identification of the URL or other specific location on Service where the material that you claim is infringing is located;</p>
                <p>0.4. your address, telephone number, and email address;</p>
                <p>0.5. a statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law;</p>
                <p>0.6. a statement by you, made under penalty of perjury, that the above information in your notice is accurate and that you are the copyright owner or authorized to act on the copyright owner’s behalf.</p>
                <p>You can contact our Copyright Agent via email at uncluttered.webapp@gmail.com.</p>
                <p>12. <b>Error Reporting and Feedback</b></p>
                <p>You may provide us either directly at uncluttered.webapp@gmail.com or via third party sites and tools with information and feedback concerning errors, suggestions for improvements, ideas, problems, complaints, and other matters related to our Service (“Feedback”). You acknowledge and agree that: (i) you shall not retain, acquire or assert any intellectual property right or other right, title or interest in or to the Feedback; (ii) Company may have development ideas similar to the Feedback; (iii) Feedback does not contain confidential information or proprietary information from you or any third party; and (iv) Company is not under any obligation of confidentiality with respect to the Feedback. In the event the transfer of the ownership to the Feedback is not possible due to applicable mandatory laws, you grant Company and its affiliates an exclusive, transferable, irrevocable, free-of-charge, sub-licensable, unlimited and perpetual right to use (including copy, modify, create derivative works, publish, distribute and commercialize) Feedback in any manner and for any purpose.</p>
                <p>13. <b>Links To Other Web Sites</b></p>
                <p>Our Service may contain links to third party web sites or services that are not owned or controlled by Uncluttered.</p>
                <p>Uncluttered has no control over, and assumes no responsibility for the content, privacy policies, or practices of any third party web sites or services. We do not warrant the offerings of any of these entities/individuals or their websites.</p>
                <p>For example, the outlined <a href="https://policymaker.io/terms-and-conditions/">Terms of Use</a> have been created using <a href="https://policymaker.io/">PolicyMaker.io</a>, a free web application for generating high-quality legal documents. PolicyMaker’s <a href="https://policymaker.io/terms-and-conditions/">Terms and Conditions generator</a> is an easy-to-use free tool for creating an excellent standard Terms of Service template for a website, blog, e-commerce store or app.</p>
                <p>YOU ACKNOWLEDGE AND AGREE THAT COMPANY SHALL NOT BE RESPONSIBLE OR LIABLE, DIRECTLY OR INDIRECTLY, FOR ANY DAMAGE OR LOSS CAUSED OR ALLEGED TO BE CAUSED BY OR IN CONNECTION WITH USE OF OR RELIANCE ON ANY SUCH CONTENT, GOODS OR SERVICES AVAILABLE ON OR THROUGH ANY SUCH THIRD PARTY WEB SITES OR SERVICES.</p>
                <p>WE STRONGLY ADVISE YOU TO READ THE TERMS OF SERVICE AND PRIVACY POLICIES OF ANY THIRD PARTY WEB SITES OR SERVICES THAT YOU VISIT.</p>
                <p>14. <b>Disclaimer Of Warranty</b></p>
                <p>THESE SERVICES ARE PROVIDED BY COMPANY ON AN “AS IS” AND “AS AVAILABLE” BASIS. COMPANY MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THEIR SERVICES, OR THE INFORMATION, CONTENT OR MATERIALS INCLUDED THEREIN. YOU EXPRESSLY AGREE THAT YOUR USE OF THESE SERVICES, THEIR CONTENT, AND ANY SERVICES OR ITEMS OBTAINED FROM US IS AT YOUR SOLE RISK.</p>
                <p>NEITHER COMPANY NOR ANY PERSON ASSOCIATED WITH COMPANY MAKES ANY WARRANTY OR REPRESENTATION WITH RESPECT TO THE COMPLETENESS, SECURITY, RELIABILITY, QUALITY, ACCURACY, OR AVAILABILITY OF THE SERVICES. WITHOUT LIMITING THE FOREGOING, NEITHER COMPANY NOR ANYONE ASSOCIATED WITH COMPANY REPRESENTS OR WARRANTS THAT THE SERVICES, THEIR CONTENT, OR ANY SERVICES OR ITEMS OBTAINED THROUGH THE SERVICES WILL BE ACCURATE, RELIABLE, ERROR-FREE, OR UNINTERRUPTED, THAT DEFECTS WILL BE CORRECTED, THAT THE SERVICES OR THE SERVER THAT MAKES IT AVAILABLE ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS OR THAT THE SERVICES OR ANY SERVICES OR ITEMS OBTAINED THROUGH THE SERVICES WILL OTHERWISE MEET YOUR NEEDS OR EXPECTATIONS.</p>
                <p>COMPANY HEREBY DISCLAIMS ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, STATUTORY, OR OTHERWISE, INCLUDING BUT NOT LIMITED TO ANY WARRANTIES OF MERCHANTABILITY, NON-INFRINGEMENT, AND FITNESS FOR PARTICULAR PURPOSE.</p>
                <p>THE FOREGOING DOES NOT AFFECT ANY WARRANTIES WHICH CANNOT BE EXCLUDED OR LIMITED UNDER APPLICABLE LAW.</p>
                <p>15. <b>Limitation Of Liability</b></p>
                <p>EXCEPT AS PROHIBITED BY LAW, YOU WILL HOLD US AND OUR OFFICERS, DIRECTORS, EMPLOYEES, AND AGENTS HARMLESS FOR ANY INDIRECT, PUNITIVE, SPECIAL, INCIDENTAL, OR CONSEQUENTIAL DAMAGE, HOWEVER IT ARISES (INCLUDING ATTORNEYS’ FEES AND ALL RELATED COSTS AND EXPENSES OF LITIGATION AND ARBITRATION, OR AT TRIAL OR ON APPEAL, IF ANY, WHETHER OR NOT LITIGATION OR ARBITRATION IS INSTITUTED), WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE, OR OTHER TORTIOUS ACTION, OR ARISING OUT OF OR IN CONNECTION WITH THIS AGREEMENT, INCLUDING WITHOUT LIMITATION ANY CLAIM FOR PERSONAL INJURY OR PROPERTY DAMAGE, ARISING FROM THIS AGREEMENT AND ANY VIOLATION BY YOU OF ANY FEDERAL, STATE, OR LOCAL LAWS, STATUTES, RULES, OR REGULATIONS, EVEN IF COMPANY HAS BEEN PREVIOUSLY ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. EXCEPT AS PROHIBITED BY LAW, IF THERE IS LIABILITY FOUND ON THE PART OF COMPANY, IT WILL BE LIMITED TO THE AMOUNT PAID FOR THE PRODUCTS AND/OR SERVICES, AND UNDER NO CIRCUMSTANCES WILL THERE BE CONSEQUENTIAL OR PUNITIVE DAMAGES. SOME STATES DO NOT ALLOW THE EXCLUSION OR LIMITATION OF PUNITIVE, INCIDENTAL OR CONSEQUENTIAL DAMAGES, SO THE PRIOR LIMITATION OR EXCLUSION MAY NOT APPLY TO YOU.</p>
                <p>16. <b>Termination</b></p>
                <p>We may terminate or suspend your account and bar access to Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of Terms.</p>
                <p>If you wish to terminate your account, you may simply discontinue using Service.</p>
                <p>All provisions of Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>
                <p>17. <b>Governing Law</b></p>
                <p>These Terms shall be governed and construed in accordance with the laws of Philippines, which governing law applies to agreement without regard to its conflict of law provisions.</p>
                <p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service and supersede and replace any prior agreements we might have had between us regarding Service.</p>
                <p>18. <b>Changes To Service</b></p>
                <p>We reserve the right to withdraw or amend our Service, and any service or material we provide via Service, in our sole discretion without notice. We will not be liable if for any reason all or any part of Service is unavailable at any time or for any period. From time to time, we may restrict access to some parts of Service, or the entire Service, to users, including registered users.</p>
                <p>19. <b>Amendments To Terms</b></p>
                <p>We may amend Terms at any time by posting the amended terms on this site. It is your responsibility to review these Terms periodically.</p>
                <p>Your continued use of the Platform following the posting of revised Terms means that you accept and agree to the changes. You are expected to check this page frequently so you are aware of any changes, as they are binding on you.</p>
                <p>By continuing to access or use our Service after any revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, you are no longer authorized to use Service.</p>
                <p>20. <b>Waiver And Severability</b></p>
                <p>No waiver by Company of any term or condition set forth in Terms shall be deemed a further or continuing waiver of such term or condition or a waiver of any other term or condition, and any failure of Company to assert a right or provision under Terms shall not constitute a waiver of such right or provision.</p>
                <p>If any provision of Terms is held by a court or other tribunal of competent jurisdiction to be invalid, illegal or unenforceable for any reason, such provision shall be eliminated or limited to the minimum extent such that the remaining provisions of Terms will continue in full force and effect.</p>
                <p>21. <b>Acknowledgement</b></p>
                <p>BY USING SERVICE OR OTHER SERVICES PROVIDED BY US, YOU ACKNOWLEDGE THAT YOU HAVE READ THESE TERMS OF SERVICE AND AGREE TO BE BOUND BY THEM.</p>
                <p>22. <b>Contact Us</b></p>
                <p>Please send your feedback, comments, requests for technical support by email: <b>uncluttered.webapp@gmail.com</b>.</p>
                <p style="margin-top: 5em; font-size: 0.7em;">These <a href="https://policymaker.io/terms-and-conditions/">Terms of Service</a> were created for <b>https://uncluterredapp.000webhostapp.com/</b> by <a href="https://policymaker.io">PolicyMaker.io</a> on 2022-12-01.</p>

            </div>
        </div>
     </div>
    <!--Footer Section-->
    <div class="row no-gutters">
        <footer class=" text-center text-lg-end fixed-bottom">
            <div class="d-flex justify-content-center p-3" style="background-color: #B2C8DF;">
            <a href="privacy.php" class="mx-2" target="_blank" rel="noopener noreferrer">Privacy and Policy</a>
            <a href="terms.php" class="mx-2">Terms and condition</a>
            <!--  <h5 style="background-color:#E78F14;"><a href="https://www.facebook.com/balayan.sti.edu/" target="_blank" class="mx-2" style="background-color:#E78F14;"><i class="bi bi-facebook" style="background-color:#E78F14;"></i></a></h5>
                <h5 style="background-color:#E78F14;"><a href="mailto:richardjohn.encarnacion@batangas.sti.edu" target="_blank" class="mx-2"><i class="bi bi-envelope-fill" style="background-color:#E78F14;"></i></a></h5>
                <h5 style="background-color:#E78F14;"><a href="https://maps.google.com/?q=STI College - Batangas, 865 National Road, Batangas, 4200 Batangas" target="_blank" class="mx-2"><i class="bi bi-geo-alt-fill" style="background-color:#E78F14;"></i></a></h5>
                <h5 style="background-color:#E78F14;"><a href="https://www.sti.edu/campuses-details.asp?campus_id=BAT" target="_blank" class="mx-2"><i class="bi bi-info-square-fill" style="background-color:#E78F14;"></i></a></h5> -->
            </div>
        </footer>
    </div>
    <script>
        
        function handleCredentialResponse(response)
        {
            const responsePayload = decodeJwtResponse(response.credential);
            console.log('ID: '+responsePayload.sub);
            console.log('Full Name: '+responsePayload.name);
            console.log('Given Name: '+responsePayload.given_name);
            console.log('Family Name: '+responsePayload.family_name);
            console.log('Image URL: '+responsePayload.picture);
            console.log('Email: '+responsePayload.email);

            var http = new XMLHttpRequest();
                http.open("POST", "../controller/signupWithGmail.php", true);
                http.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                //This is the form input fields data
                var params = "submitBtn="+true+
                            "&usernameTb="+responsePayload.email+
                            "&passwordTb="+responsePayload.sub+
                            "&fnameTb="+responsePayload.given_name+
                            "&lnameTb="+responsePayload.family_name+
                            "&emailTb="+responsePayload.email+
                            "&imageName="+responsePayload.picture+
                            "&gmail_IdTb="+responsePayload.sub; // probably use document.getElementById(...).value

                http.send(params);
                http.onload = function() 
                {
                    var signupRes = http.responseText;
                    console.log(signupRes);

                    if(signupRes =='1')
                    {
                        url.searchParams.set('signupRes', signupRes);
                        window.history.replaceState(null, null, url); // or pushState
                        location.reload();
                        
                    }
                    else if(signupRes =='2')
                    {
                        url.searchParams.set('signupRes', signupRes);
                        window.history.replaceState(null, null, url); // or pushState
                        window.location = '../index.php';
                    }
                    //returnDate();
                    //console.log(params);
                }
        }

        function decodeJwtResponse(data)
        {
            var tokens = data.split(".");
            return JSON.parse(atob(tokens[1]));
        }
    </script>
<?php
    if(isset($_GET['response'])==1)
    {
        ?>
        <!-- Alert message container-->
        <div id="alertBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:block ;">
            <strong id="errorMsg">Username doesn't exist!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            //to reset the $_GET in URL
            url.searchParams.delete('response');
            window.history.replaceState(null, null, url); // or pushState
        </script>
        <?php

    }

?>
</body>
</html>

