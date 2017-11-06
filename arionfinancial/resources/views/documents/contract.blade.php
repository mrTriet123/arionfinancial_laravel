<html moznomarginboxes mozdisallowselectionprint>
  <head>
    <title>Contract</title>
    <link href="{!!asset('vendors/bootstrap/dist/css/bootstrap.min.css')!!}" rel="stylesheet">
    <style>
      table{
        text-align: left;
      }
      div.container{
        width: 660px;
      }
      div.header{
        margin-top: 20px;
        margin-bottom: 30px;
      }
      p{
        margin: 0;
        text-align: justify;
      }
      p.title{
        font-size: 13px;
        font-weight: 700;
        margin-top: 5px;
        margin-bottom: 5px;
      }
      p.sub{
        font-size: 12px;
        margin-left: 5px;
      }

      p.sub-email{
        font-size: 10px;
      }
      p.headline-1{
        text-align: center;
        font-weight: 700;
        font-size: 15px;
        text-decoration: underline;
      }
      span.counter{
        width: 36px;
        display: inline-block;
      }
      span.counter-sub1{
        padding-left: 8px;
      }
      span.counter-sub2{
        padding-left: 16px;
      }
      div.m-header{
        border: solid 1px;
        padding: 6px;
        margin-top: 15px;
        margin-bottom: 15px;
      }
      section{
        margin-top: 15px;
        margin-bottom: 15px;
      }
      hr.line{
        border-color: #000;
      }
      div.tb-border{
        border: solid 1px;
        margin-top: 15px;
        margin-bottom: 15px;
      }
      table.tbl-infor2{
        width: 100%;
      }
      .page-break {
          page-break-after: always;
      }
      table.tbl-quotation{
        margin: 15px auto;
      }
      table.tbl-quotation tr th:first-child{
        width: 400px;
      }
      table.tbl-quotation tr td{
        width: 70px;
      }
      /*table.tbl-quotation1 th{
        width: 450px;
      }*/

    </style>
  </head>
    <div class="container">
      <div class="row header">
        <h3 class="text-center"><b>LEASE AGREEMENT WITH OPTION TO PURCHASE</b></h3>
      </div>
      <div class="row m-header">
        <div class="col-xs-3 col-sm-3">
          <p class="title">LESSOR / OWNER OF PROPERTY</h2>
          <p class="sub">{{$dearlerInfor['FirstName']}} {{$dearlerInfor['LastName']}}</p>
          <p class="sub">{{$dearlerInfor['CompanyName']}}</p>
          <p class="sub">{{$dearlerInfor['Address']}}</p>
          <p class="sub">Telephone:{{$dearlerInfor['Phone']}}</p>
          <p class="sub">Website:</p>
        </div>
        <div class="col-xs-3 col-sm-3">
          <p class="title">LESSEE:</h2>
          <p class="sub">{{$fname}}<?php if(!empty($mname)) echo ' '.$mname.'.'; ?> {{$lname}}</p>
          <!--<p class="sub">and {{$fname}}<?php if(!empty($mname)) echo ' '.$mname.'.'; ?> {{$lname}}</p>-->
          <!--<p class="sub">#address</p>-->
          <p class="sub">Apt / Suite:<?php if(empty($apt)) echo 'N/A'; else echo $apt; ?></p>
          <p class="sub">Nevada  {!! $zipcode !!}</p>
          <p class="sub">Home Phone:<?php if(empty($add_phone)) echo 'N/A'; else echo $add_phone; ?></p>
          <p class="sub">Mobile Phone:  {!! $p_phone !!}</p>
          <p class="sub <?php if(strlen($email) > 20) echo 'sub-email' ?>">Email: {!! $email !!}</p>
        </div>
        <div class="col-xs-4 col-sm-4">
          <p class="title">LEASE NUMBER: {{$id}} </h2>
          <p class="title">LEASE DATE: {{(new Datetime())->format('F j, Y')}} </h2>
<!--          <p class="title">RETAILER:</h2>
          <p class="sub">Big’s Furniture 1080 W. Sunset Rd.</p>
          <p class="sub">Henderson, NV 89014 (702) 434-3408</p>-->
        </div>
      </div>

      <?php 
        $cashPriceOfProperty = $cash_price;
        $taxRate = $tax_rate;
        $numberOfPayments = $num_pay;
        $initialPayment = $init_payment;
        $initialPaymentTax = round(($initialPayment * $taxRate /100 ), 2);
        $initialPaymentWithTax = $initialPayment + $initialPaymentTax;
        $periodicalPayment = $payment_amount;
        $periodicalPaymentTax = round($payment_amount * $taxRate / 100, 2);
        $periodicalPaymentWithTax = $periodicalPayment + $periodicalPaymentTax;
        $firstPaymentDate = (new Datetime($fpay))->format('m/d/Y');
        $constOfRental = $cost_rental;
        $termOfPayment = $term_of_pay;
        $paymentAmount = $payment_amount;
        $paymentAmountTax = round($paymentAmount * $taxRate / 100, 2);
        $paymentAmountWithTax = $paymentAmount + $paymentAmountTax;
      ?>
      <div class="row">
        <section>
          <p>This <b>Lease Agreement with Option to Purchase</b> (the "Lease") includes this Disclosure Page and the Additional Lease Terms on pages 2 – 6. In this Lease, "you" and "your" mean the person(s) signing this Lease as Lessee and/or Co-Lessee, and "we," "our," and "us" mean the Lessor/Owner identified above and its successors and assigns.</p>
        </section>
        <section>
          <p><b>LEASE DISCLOSURES: </b>The Initial Payment of ${{$initialPaymentWithTax}} (${{ $initialPayment }} plus sales tax of ${{ $initialPaymentTax }}) is due at the time of signing of this Lease. In addition to the Initial Payment, you may renew this Lease by tendering {{ $numberOfPayments }} payments of ${{$periodicalPaymentWithTax}} (${{$periodicalPayment}} plus sales tax of ${{$periodicalPaymentTax}}), paid {{ $termOfPayment}}, for a Total of Payments of <b>${{ $periodicalPaymentWithTax }}</b>. The payment amount may change to the extent the applicable sales tax rate changes after the date of this Lease. Applicable sales tax will be added to all payments. You do not acquire ownership rights to the Property unless you comply with the ownership terms outlined in this Lease. If the Property is lost, stolen, damaged, or destroyed you will continue to be liable for either the total remaining to be paid on the Lease or the fair market value, as determined by us, of the Property on the date of the loss, plus applicable fees and costs that have accrued, whichever is less. You are leasing the following new item(s) of personal property from Lessor/Owner of the Property: </p>
          <p>1. ${{$cash_price}}</p>
        <!--<p>2. N/A</p>
          <p>3. N/A</p>
          <p>4. N/A</p>
          <p>5. N/A</p>-->
          <p>(collectively the “Property”). The Cash Price of the Property is $2000 (excluding sales tax), which the parties agree is the amount one would charge for a cash sale of the Property and is the estimated fair market value of the Property on the Lease Date. The Total of Payments does not include fees such as reinstatement fees, returned payment fees, collection fees, or other taxes, fees or costs that may accrue during the Lease. Lessee will not have any ownership interest in the Property unless and until Lessee complies with the terms and conditions of this Agreement, including the payment of all fees and payments stated herein.  Lessee may terminate the agreement without penalty by voluntarily surrendering or returning the leased property in good repair at the expiration of the term of the lease, and paying any rental payments that are past due. Additional Fees: Returned Payment Fee: Any payment you make on this Lease that is returned as unpaid will result in a $25.00 Returned Payment Fee being assessed to your Lease account. Home Collection Fee: We will charge you $50.00, up to three (3) times per six (6) months, each time we make a trip to collect any payment from you, with no obligation to do so. Payment Processing Fee: Payments that are processed by our representatives after you request us to process a payment will be charged a Payment Processing Fee of $5.00. Late Fee:  The Late Fee will be at least $10.00 but the fee will not exceed the lesser of $20.00 or 10% of the delinquent payment. There is a Change Payment Date Fee of $30.00 if you request a new payment due date that is more than five (5) days after the currently scheduled payment date. We own the Property until you pay the Total of Payments for this Lease, plus pay fees and costs that may have accrued. If you want to purchase this or similar property now, you should consider other cash or credit terms that may be available to you. See § 5 for additional information. You are responsible for maintaining the Property in its original condition, normal wear and tear excluded. If you acquire ownership of the Property, the unexpired portion of the manufacturer’s express warranty will be transferred to you if the warranty is still in effect and we are allowed to do so. You may terminate the Lease without penalty by voluntarily surrendering or returning the Property, in good repair, in accordance with the directions that we give you and by paying any rental payments and fees that are then due. Right to Reinstate: If you fail to make a timely payment you may reinstate this Lease, without losing any right or option previously acquired, by paying all past due amounts, and applicable late fees and costs that may have accrued: (a) within five (5) days after the date for renewing the Lease if you are required to make monthly payments; or (b) within two (2) days after the date for renewing the Lease if your payments are required to be made more frequently than monthly. If the Property was returned during the reinstatement period, the right to reinstate the Lease is extended for 21 days from the date the Property was returned to us unless you have paid at least two-thirds of the total amount of payments necessary to acquire ownership of the property at which point you then have forty-five (45) days to reinstate.</p>
        </section>
        <section>
          <p>By signing this Lease (1) you acknowledge that you have read and understand the Lease and its terms; (2) you agree to all its terms, including the Additional Lease Terms on pages 2 – 6 and Exhibit A thereto (see EFT AND CARD CHARGE AUTHORIZATION (§ 9), ARBITRATION PROVISION (§ 14), and LIMITATION OF LIABILITY (§ 15), intending to be legally bound; (3) if there is more than one Lessee, you promise that you are each receiving possession of the property and will be jointly and severally responsible to Lessor; and (4) you acknowledge receipt of a completed copy of this Lease.</p>
        </section>
        <section>
          <div class="tb-border clearfix">
            <table class="tbl-infor tbl-infor2">
              <tr>
                <td style="width:50%; padding: 15px; border-right: solid 1px; vertical-align: top">
                  <div class="row">
                    <div class="col-xs-6">
                      <p class="title">LESSEE:</p>
                      <br />
                      <hr class="line"/>
                      <p class="title">{{$fname}}<?php if(!empty($mname)) echo ' '.$mname.'.'; ?> {{$lname}}</p>
                    </div>
                    <div class="col-xs-6">
                      <p class="title">Dated</p>
                      <br />
                      <p class="title">{!! (new Datetime())->format('m/d/Y') !!}</p>

                    </div>
                  </div>
                </td>
                <td style="width:50%; padding: 15px;">
                  <div class="row">
                    <div class="col-xs-6">
                      <p class="title">LESSOR:	</p>
                      <br />
                      <hr class="line"/>
                      <p class="title">An authorized signatory for Titan Lease, LLC, a Nevada limited liability company</p>
                      <br />
                    </div>
                    <div class="col-xs-6">
                      <p class="title">Dated</p>
                      <br />
                      <p class="title">{!! (new Datetime())->format('m/d/Y') !!}</p>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </section>
        <div class="page-break"></div>
        <section><p class="headline-1">ADDITIONAL LEASE TERMS</p></section>
        <section>
          <p><span class="counter">1)</span>	LEASED PROPERTY: You are leasing the personal property described as the Property in the Lease Disclosures above from Lessor, and in consideration thereof and the terms and conditions stated herein, and other good and valuable consideration, the receipt and sufficiency of which the parties hereby acknowledge, Lessor hereby lease the Property to Lessee on the terms and conditions stated herein.</p>
        </section>
        <section>
          <p><span class="counter">2)</span>TOTAL COST/PAYMENTS: You are renting this Property and you will not own it unless you pay the Total of Payments (defined below), or you exercise an Early Ownership Option (see § 6 below), plus fees and costs that may have accrued. The Initial Payment of ${{$initialPaymentWithTax}} (${{ $initialPayment }} plus sales tax of ${{ $initialPaymentTax }}) is due at the time of signing. In addition to the Initial Payment, you may renew this Lease by tendering {{ $numberOfPayments }} payments of ${{$periodicalPaymentWithTax}} (${{$periodicalPayment}} plus sales tax of ${{$periodicalPaymentTax}}), paid {{ $termOfPayment}}, for a Total of Payments of ${{ $periodicalPaymentWithTax }}. The payment amount may change to the extent the applicable sales tax rate changes after the date of this Lease. Applicable sales tax will be added to all payments. The Total of Payments does not include fees such as reinstatement fees, returned payment fees, collection fees, or other fees or costs that may accrue during the Lease. The first renewal payment of ${{$periodicalPaymentWithTax}} (includes sales tax) is due on, and each remaining renewal payment shall be due on the same day of the following month. The Cash Price of the Property is ${{$cash_price}} (excludes sales tax), which is the amount we would charge for a cash sale of the Property and also the estimated fair market value of the Property on the Lease Date. The Cost of Rental is ${{$constOfRental}}, which represents the difference between Total of Payments (excluding tax) and the Cash Price (excluding tax). The Total Cost of the Lease is the Initial Payment of ${{ $initialPayment }}, plus {{ $numberOfPayments }} payments of ${{$periodicalPaymentWithTax}}, paid {{ $termOfPayment}}, plus all other taxes, fees and charges necessary to acquire ownership of the Property. You do not acquire ownership rights to the Property unless you comply with the ownership terms outlined in this Lease. There is no minimum period or term for which you are obligated under this Lease.</p>
        </section>
        <section>
          <p><span class="counter">3)</span>MAINTENANCE AND LIABILITY FOR DAMAGES: You are responsible for maintaining the Property in its original condition, normal wear and tear excluded. If the Property is lost, stolen, damaged, or destroyed you will continue to be liable for either the total remaining to be paid on the Lease or the fair market value, as determined by us, of the Property on the date of the loss, plus applicable fees and costs that have accrued, whichever is less.</p>
        </section>
        <section>
          <p><span class="counter">4)</span>INSURANCE AND WARRANTY: We do not carry any insurance on the Property nor do we require that you purchase insurance for the Property, including insurance from us or from any insurer owned or controlled by us. If you acquire ownership of the Property, the unexpired portion of the manufacturer’s express warranty will be transferred to you if the warranty is still in effect and we are allowed to do so.</p>
        </section>
        <section>
          <p><span class="counter">5)</span>OWNERSHIP: <strong class="text-strong"><u>This is a lease transaction and you do not own the Property unless you comply with the ownership terms outlined in this Lease.</u></strong> This Lease will renew automatically from scheduled payment date to scheduled payment date unless it is ended or you make all the payments required to acquire the Property. The initial term of this Lease ends when your first renewal payment is due. We own the property until you pay the Total of Payments for this Lease, plus fees and costs that may have accrued. If you want to purchase this or similar property now, you should consider other cash or credit terms that may be available to you.</p>
        </section>
        <section>
          <p><span class="counter">6)</span>TERMINATION: The initial term of this Lease is less than four months, and you can terminate this agreement at any time without penalty by voluntarily surrendering or returning the Property, in good repair, in accordance with the directions that we give you and by paying any rental payments and fees that are past due. You will also be held liable for payments, as outlined in § 3, if the Property is lost, stolen, damaged, or destroyed prior to its return to us. We may terminate this Lease and recover the Property if you are in default or you are in breach of this Lease. There is no minimum lease term.</p>
        </section>
        <section>
          <p><span class="counter">7)</span>DEFAULT AND REINSTATEMENT: Your account will be in default if payment is not received on or by the date it is due. LATE FEE: You will be charged a Late Fee if your payments are due monthly and we have not received payment within seven (7) days of its due date. You will be charged a Late Fee if your payments are due more frequently than monthly and we have not received payment within three (3) days of its due date. The Late Fee will be at least $10.00 but the fee will not exceed the lesser of $20.00 or 10% of the delinquent payment. REINSTATEMENT: If you fail to make a timely payment you may reinstate this Lease, without losing any right or option previously acquired, by paying all past due amounts, and applicable late fees and costs that may have accrued: (a) within five (5) days after the date for renewing the Lease if you are required to make monthly payments; or (b) within two (2) days after the date for renewing the Lease if your payments are required to be made more frequently than monthly. If the Property was returned during the reinstatement period the right to reinstate the Lease is extended for 21 days from the date the Property was returned to us unless you have paid at least two-thirds of the total amount of payments necessary to acquire ownership of the property at which point you then have forty-five (45) days to reinstate.</p>
        </section>
        <section>
          <p><span class="counter">8)</span>PAYMENT METHOD: As provided immediately below, you authorize us to initiate electronic fund transfers (“EFTs”) from the account identified below, or any substitute bank account discovered by Lessor belonging to Lessee (the “Bank Account”) or charge the payment card identified below (the “Card”) for each required payment, including fees that have accrued. Card information Error! Reference source not found., Account No. Error! Reference source not found.. Bank Account information – tBank Name; Routing No.: ####; Account No.: ####.</p>
        </section>
        <section>
          <p><span class="counter">9)</span>RECURRING EFT AND CARD CHARGE AUTHORIZATION: You authorize us to initiate an EFT over the ACH network (or another network of our choosing) from the Bank Account for any scheduled payment you owe under this Lease on or after its due date. We are not responsible for any bank fees you incur in connection with returned payments. Instead of or in addition to any of the EFTs and Card charges described in this section, you also authorize us to process any EFTs or Card charges you subsequently confirm by phone, text message or email. Returned Payment: In the event that this EFT is returned unpaid, you authorize us to charge your Card for such payment. You also authorize us to initiate a separate EFT or to charge the Card for any fee that you owe under this Lease. You agree that we may resubmit any returned EFT or Card charge as permitted by law and network rules. Compliance: You agree that the ACH transaction, debit card and credit card transaction you choose to authorize comply with applicable law. Correction: In the event that we make an error in processing an EFT or Card charge, you authorize us to initiate an EFT or Card charge to correct the error. This authorization is non-negotiable. Updating Payment Information: You may update the Bank Account and Card information by calling us at (702) 979-3639 or writing us at 2360 Corporate Circle, Suite 330, Attn: David Dachelet, Henderson, Nevada 89074. We will honor your modification requests so long as you make this request at least three (3) business days before the scheduled payment or far enough in advance for us to reasonably act on it. Change Payment Date: You may request to change your scheduled payment dates, which we will typically grant if the new payments coincide with the dates you receive income and the change does not materially increase the Lease term, by calling us at (702) 979-3639 or writing us at 2360 Corporate Circle, Suite 330, Attn: David Dachelet, Henderson, Nevada 89074. To request to change your scheduled payment dates you must fill out the Change Payment Date form, return the form to us, and pay the Change Payment Date Fee (if the fee applies) at least three business days before the next scheduled payment or far enough in advance for us to reasonably act on it. There is a Change Payment Date Fee of $30.00 if you request a new payment due date that is more than five (5) days after the currently scheduled payment date. Termination: This authorization remains in force until you notify us, by sending an email to:  payments@titanlease.com, that you wish to cancel or revoke it. You must notify us of termination of authorization at least three (3) business days before the next scheduled payment or far enough in advance for us to reasonably act on it. If any payment cannot be obtained by EFT or Card charge, you remain responsible for such payment.</p>
        </section>
        <section>
          <p><span class="counter">10)</span>ADDITIONAL FEES: RETURNED PAYMENT FEE: Any payment you make on this Lease that is returned as unpaid will result in a $25.00 Returned Payment Fee being assessed to your Lease account. HOME COLLECTION FEE: We will charge you $50.00, up to three (3) times per six (6) months, each time we make a trip to collect any payment; however, we are not obligated to collect payments in such manner, which shall be performed in Lessor’s sole discretion. PAYMENT PROCESSING FEE: Payments that are processed by our representative after you request us to process a payment will be charged a Payment Processing Fee of $5.00.</p>
        </section>
        <section>
          <p><span class="counter">11)</span>ACCOUNT AND MARKETING COMMUNICATIONS: Phone Calling (Including Text Message) Consent: If you have listed a wireline or wireless phone number in the documents we receive from you or you give us an updated contact number, then you authorize us, our affiliates, successors in interest, and assigns to call (including SMS (Short Message Service)) using systems as outlined here: ACCOUNT COMMUNICATIONS: We may use automated telephone dialing, artificial/pre-recorded messages, text messaging systems and electronic mail to provide messages to you about scheduled payments, missed payments, account status, Lease information, other important account information, and to verify your identity and contact information. The telephone messages are artificial/pre-recorded and are played by a machine automatically when the telephone is answered, whether answered by you or someone else. These messages may also be recorded by your answering machine and may be heard by a third-person. Electronic Communications: You also give us permission to communicate account information to you by e-mail and online. You understand that when you receive such calls, texts, or e-mails, you may incur a charge from the company that provides you with telecommunications, wireless and/or Internet services and your service provider’s message and data rates apply. You understand and agree that we may monitor and/or record any of the phone calls between you and us. MARKETING COMMUNICATIONS: We may share your name and contact information, and information about this Lease, with our affiliates and with nonaffiliated companies that may or may not extend credit to consumers. Your information may be used by us or by these companies for marketing purposes. If you opt-in to receive such communications you, also give us permission to market our products to you by using automated telephone dialing, artificial/pre-recorded messages, and SMS and text messaging systems. You also acknowledge that we are not requiring you to provide authorization for telemarketing calls (including telemarketing SMS text messages) as a condition for doing business with us. You have the right to prevent this sharing and marketing communications. To exercise this right, call us at 702-979-3639.  You understand that regardless of your choice for “Marketing Communications,” by providing your wireless number, you have expressly consented in writing to receive account transaction calls (including SMS text messages) that use an automatic dialing system and artificial/pre-recorded messages as explained in this Section.</p>
        </section>
        <section>
          <p><span class="counter">12)</span>CREDIT REPORTING: You authorize us to make inquiries concerning your credit history and standing. We may report information about your Lease to credit bureaus, but we are not required to do so. Late payments, missed payments or other defaults on your Lease may be reflected in your credit report. If you believe that any information about your Lease that we have furnished to a consumer reporting agency is inaccurate, or if you believe that you have been the victim of identity theft in connection with any Lease made by us, write to us at the address appearing at the top of this Lease (the Lessor/Owner address), attention “CREDIT REPORTING.” In your letter (i) provide your name, mailing address and phone number, (ii) identify the specific information that is being disputed, (iii) explain the basis for the dispute and (iv) provide any supporting documentation you have that substantiates the basis of the dispute. If you believe that you have been the victim of identity theft, please submit an identity theft affidavit or identity theft report.</p>
        </section>
        <section>
          <p><span class="counter">13)</span>MISCELLANEOUS: Entire Agreement: This Lease constitutes the entire agreement between you and us concerning the Property. Assignment: We may sell, transfer or assign this Lease and notice of such assignment will be provided only if a change is made to the method of payment or any contact information. Prohibited Acts: You may not sell, assign, mortgage, pawn, pledge, encumber, hock, or otherwise dispose of the Property. You may not remove the Property from your current residence without our written consent. Each of the foregoing acts is a breach of this Lease, as is failing to make payments or not paying fees and charges. Right to Take Possession: If you are in breach of this Lease or you do not renew, we have the right to take possession of the Property without breaching the peace. You agree to pay all costs we incur in taking possession of the Property to the extent permitted by law. Accord and Satisfaction: Any statement accompanying your payment to the effect that your balance is paid in full will not bind us. Our deposit of any such payments will not constitute an accord and satisfaction, and we may apply the payment to your account. Governing Law: This Lease is governed by the laws of the State Nevada, without regard to its conflict of law principles. Attorney Fees: In any legal action, arbitration or proceeding whereby Lessor seeks to enforce any of the provisions of this Lease, Lessor shall be entitled to an award of its reasonably expended attorney fees and costs related to same, including any such fees and costs on appeal thereof. Consumer Report: You understand and agree that we may obtain a consumer report on you in connection with this Lease. Upon your written request, you will be informed of whether or not such a report was obtained and, if so, the name and address of the agency that furnished it.</p>
        </section>
        <section>
          <section>
            <p><span class="counter">14)</span>ARBITRATION PROVISION: </p>
          </section>
          <section>
            <p><span class="counter counter-sub1">a)</span>Effect of Arbitration Provision. The parties agree that either party may elect to arbitrate or require arbitration of any Claim under this Arbitration Provision.</p>
          </section>
          <section>
            <p><span class="counter counter-sub1">b)</span>Certain Definitions. As used in this Arbitration Provision, the following terms have the following meanings: (i) References to “we,” “us” and “our” include our “Related Parties” — all our parent companies, subsidiaries and affiliates, and our and their employees, directors, officers, shareholders, governors, managers and members. Our “Related Parties” also include third parties that you bring a Claim against at the same time you bring a Claim against us or any other Related Party, including, without limitation, the merchant who sold us the Property we then leased to you. (ii) “Claim” means any claim, dispute or controversy between you and us (including any Related Party) that arises from or relates in any way to this Lease or the Property (including any amendment, modification or extension of this Lease); any prior lease between you end us, and/or the property subject to such prior lease; any of our marketing, advertising, solicitations and conduct relating to this Lease, the Property and/or a prior lease and related property; our collection of any amounts you owe; or our disclosure of or failure to protect any information about you. “Claim” is to be given the broadest reasonable meaning and includes claims of every kind and nature, including but not limited to, initial claims, counterclaims, cross-claims and third-party claims, and claims based on constitution, statute, regulation, ordinance, common law rule (including rules relating to contracts, torts, negligence, fraud or other intentional wrongs) and equity. It includes disputes that seek relief of any type, including damages and/or injunctive, declaratory or other equitable relief. Despite the foregoing, “Claim” does not include any individual action brought by you in small claims court or your state’s equivalent court, unless such action is transferred, removed, or appealed to a different court. In addition, except as set forth In the immediately following sentence, “Claim” does not include disputes about the validity, enforceability, coverage or scope of this Arbitration Provision or any part thereof (including, without limitation, subsections (f)(iii), (f)(iv) and/or (f)(v) (the “Class Action and Multi-Party Claim Waiver”), the last sentence of subsection (j) and/or this sentence); all such disputes are for a court and not an arbitrator to decide. However, any dispute or argument that concerns the validity or enforceability of this Lease as a whole is for the arbitrator, not a court, to decide. (iii) “Proceeding” means any judicial or arbitration proceeding regarding any Claim. “Complaining Party” means the party who threatens or asserts a Claim in any Proceeding and “Defending Party” means the party who is a subject of any threatened or actual Claim. “Claim Notice” means written notice of a Claim from a Complaining Party to a Defending Party.</p>
          </section>
          <section>
            <p><span class="counter counter-sub1">c)</span>Arbitration Election; Administrator; Arbitration Rules.</p>
          </section>
          <section>
          <p><span class="counter counter-sub2">i)</span>A Proceeding may be commenced after the Complaining Party complies with subsection (k). The Complaining Party may commence the Proceeding either as a lawsuit or an arbitration by following the appropriate filing procedures for the court or the arbitration administrator selected by the Complaining Party in accordance with this subsection I. If a lawsuit is filed, the Defending Party may elect to demand arbitration under this Arbitration Provision of the Claim(s) asserted in the lawsuit. If the Complaining Party initially asserts a Claim in a lawsuit on an individual basis but then seeks to assert the Claim on a class, representative or multi-party basis, the Defending Party may then elect to demand arbitration. A demand to arbitrate a Claim may be given in papers or motions in a lawsuit. If you demand that we arbitrate a Claim initially brought against you in a lawsuit, your demand will constitute your consent to arbitrate the Claim with the administrator of our choice, even if the administrator we choose does not typically handle arbitration proceedings initiated against consumers.</p>
          </section>
          <section>
          <p><span class="counter counter-sub2">ii)</span>Any arbitration Proceeding shall be conducted pursuant to this Arbitration Provision and the applicable rules of the arbitration administrator in effect at the time the arbitration is commenced. The arbitration administrator will be the American Arbitration Association (“AAA”) located within Las Vegas, Nevada, www.adr.org., or JAMS located in Las Vegas, Nevada, www.jamsade.org; or any other company or arbitrator selected by mutual agreement of the parties. If both AAA and JAMS cannot or will not serve and the parties are unable to select an arbitration administrator by mutual consent, the administrator will be selected by a court. Notwithstanding any language in this Arbitration Provision to the contrary, no arbitration may be administered, without the consent of all parties to the arbitration, by any arbitration administrator that has in place a formal or informal policy that is inconsistent with the Class Action and Multi-Party Claim Waiver. The arbitrator will be selected under the administrator’s rules, except that the arbitrator must be a lawyer with at least ten years of experience or a retired judge unless the parties agree otherwise.</p>
          </section>
          <section>
          <p><span class="counter counter-sub1">d)</span>Non-Waiver. Even if all parties have elected to litigate a Claim in court, you or we may elect arbitration with respect to any Claim made by a new party or any new Claim asserted in that lawsuit (including a Claim initially asserted on an individual basis but modified to be asserted on a class, representative or multi-party basis), and nothing in that litigation shall constitute a waiver of any rights under this Arbitration Provision. This Arbitration Provision will apply to all Claims, even if the facts and circumstances giving rise to the Claims existed before the effective date of this Arbitration Provision.</p>
          </section>
          <section>
          <p><span class="counter counter-sub1">e)</span>Location and Costs. The arbitrator may decide that an in-person hearing is unnecessary and that he or she can resolve a Claim based on the documents submitted by the parties and/or through a telephone hearing. </p>
          </section>
          <section>
          <p><span class="counter counter-sub1">f)</span>No Class Actions or Similar Proceedings; Special Features of Arbitration. IF YOU OR WE ELECT TO ARBITRATE A CLAIM AS PROVIDED FOR HEREIN, NEITHER YOU NOR WE WILL HAVE THE RIGHT TO: (i) HAVE A COURT OR JURY DECIDE THE CLAIM; (ii) OBTAIN INFORMATION PRIOR TO THE HEARING TO THE SAME EXTENT THAT YOU OR WE COULD IN COURT; (iii) PARTICIPATE IN A CLASS ACTION IN COURT OR IN ARBRITRATION, EITHER AS A CLASS REPRESENTATIVE, CLASS MEMBER OR CLASS OPPONENT; (iv) ACT AS A PRIVATE ATTORNEY GENERAL IN COURT OR IN ARBITRATION; OR (v) JOIN OR CONSOLIDATE CLAIM(S) INVOLVING YOU WITH CLAIMS INVOLVING ANY OTHER PERSON. THE RIGHT TO APPEAL IS MORE LIMITED IN ARBITRATION THAN IN COURT. OTHER RIGHTS THAT YOU WOULD HAVE IF YOU WENT TO COURT MAY ALSO NOT BE AVAILABLE IN ARBITRATION.</p>
          </section>
          <section>
          <p><span class="counter counter-sub1">g)</span>Getting Information. In addition to the parties’ rights under the arbitration administrator’s rules to obtain information prior to the hearing, either party may ask the arbitrator for more information from the other party. The arbitrator will decide the issue in his or her sole discretion, after allowing the other party the opportunity to object.</p>
          </section>
          <section>
          <p><span class="counter counter-sub1">h)</span>Effect of Arbitration Award. Any court with jurisdiction may enter judgment upon the arbitrator’s award, which will be final and non-appealable, except as expressly authorized by applicable law.</p>
          </section>
          <section>
          <p><span class="counter counter-sub1">i)</span>Governing Law. The Lease involves interstate commerce and this Arbitration Provision shall be governed by the FAA, and not Federal or state rules of civil procedure or evidence or any state laws that pertain specifically to arbitration. This Arbitration Provision is governed by the laws of the state of Nevada without regard to its conflict of law principles. The arbitrator is bound by the terms of this Arbitration Provision. The arbitrator shall follow applicable substantive law to the extent consistent with the FAA, applicable statutes and contracts of limitation and applicable privilege rules, and shall be authorized to award all remedies available in an individual lawsuit under applicable substantive law, including, without limitation, compensatory, statutory and punitive damages (which shall be governed by the constitutional standards applicable to judicial proceedings), declaratory, injunctive and other equitable relief, and attorney fees and costs. The arbitrator shall issue a reasoned written decision sufficient to explain the essential findings and conclusions on which the award is based.</p>
          </section>
          <section>
          <p><span class="counter counter-sub1">j)</span>Survival, Severability, Primacy. In the event of any conflict or inconsistency between this Arbitration Provision and the administrator’s rules or the remainder of this Lease, this Arbitration Provision will govern. This Arbitration Provision shall survive the full payment of any amounts due under this Lease; any rescission or cancellation of this Lease; any exercise of a self-help remedy; our sale or transfer of this Lease or our rights under this Lease; any legal proceeding by us to collect a debt owed by you; and your (or our) bankruptcy. If any part of this Arbitration Provision cannot be enforced, the remainder of this Arbitration Provision will continue to apply. However, if the Class Action and Multi-Party Claim Waiver is declared invalid in a proceeding between you and us, without in any way impairing the right to appeal such decision, this entire Arbitration Provision (other than this sentence) shall be null and void in such proceeding.</p>
          </section>
          <section>
          <p><span class="counter counter-sub1">k)</span>Pre-Dispute Resolution Procedure. Before a Complaining Party asserts a Claim in any Proceeding (including as an individual litigant or as a member or representative of any class or proposed class), the Complaining Party shall give the Defending Party: (1) a Claim Notice providing at least 30 days’ written notice of the Claim and explaining in reasonable detail the nature of the Claim and any supporting facts; and (ii) a reasonable good faith opportunity to resolve the Claim on an individual basis without the necessity of a Proceeding. If you are the Complaining Party, you must send any Claim Notice to us at 2360 Corporate Circle, Suite 330, Henderson, Nevada 89074, Attn: David Dachelet (or such other address as we shall subsequently provide to you). If we are the Complaining Party, we will send the Claim Notice to you at your address appearing in our records or, if you are represented by an attorney, to your attorney at his or her office address. If the Complaining Party and Defending Party do not reach an agreement to resolve the Claim within 30 days after the Claim Notice is received, the Complaining Party may commence a Proceeding, subject to the terms of this Arbitration Provision. Neither the Complaining Party nor the Defending Party shall disclose in any Proceeding the amount of any settlement demand made by the Complaining Party or any settlement offer made by the Defending Party until after the arbitrator or court determines the amount, if any, to which the Complaining Party is entitled (before the application of subsection (l) of this Arbitration Provision). No settlement demand or settlement offer may be used in any Proceeding as evidence or as an admission of any liability or damages.</p>
          </section>
        </section>
        <section>
          <p><span class="counter">15)</span>LIMITATION OF LIABILITY:  To the fullest extent permitted by applicable law, the parties agree that (i) any award of damages against Lessor and in favor of Lessee shall be limited to an amount equal to the Total of Payments that were or would have been due under this Lease if fully consummated by Lessee plus any damages or awards specifically authorized by statute.</p>
        </section>
        <div class="page-break"></div>
        <section >
          <p class="headline-1">FOR INTERNAL USE ONLY</p>
          <p class="text-center"><strong>LEASE INFORMATION</strong></p>
          <table class="tbl-quotation">
            <tr>
              <th>&nbsp;</th>
            </tr>
            <tr>
              <td>Cash Price of Property</td>
              <td>${{$cashPriceOfProperty}}</td>
            </tr>
            <tr>
              <td>Tax Rate (subject to change)</td>
              <td>{{$taxRate}}%</td>
            </tr>
            <tr>
              <td>Number of Payments</td>
              <td>{{$numberOfPayments}}</td>
            </tr>
            <tr>
              <td>Initial Payment (w/ Tax)</td>
              <td>${{$initialPaymentWithTax}}</td>
            </tr>
            <tr>
              <td class="text-capitalize">{{$termOfPayment}} Payment (no tax)</td>
              <td>${{$paymentAmount}}</td>
            </tr>
            <tr>
              <td class="text-capitalize">{{$termOfPayment}} Payment Sales Tax</td>
              <td>${{ $paymentAmountTax }}</td>
            </tr>
            <tr>
              <td class="text-capitalize">{{$termOfPayment}} Payment(with tax)</td>
              <td>${{ $paymentAmountWithTax }}</td>
            </tr>
            <tr>
              <td>First Payment Date</td>
              <td>{{$firstPaymentDate}}</td>
            </tr>
            <tr>
              <td>Cost of Rental</td>
              <td>${{ $constOfRental }} </td>
            </tr>
          </table>
          <table class="tbl-quotation">
            <tr>
              <th>ACH / Payment Info</th>
              <th>&nbsp;</th>
            </tr>
            <tr>
              <td>Checking Bank Name</td>
              <td>###</td>
            </tr>
            <tr>
              <td>Checking Bank Routing Number</td>
              <td>###</td>
            </tr>
            <tr>
              <td>Checking Bank Account No</td>
              <td>###</td>
            </tr>
          </table>
        </section>
        <section>
          <table>
            <tr>
              <td>Lessee Name:</td>
              <td>{{$fname}}<?php if(!empty($mname)) echo ' '.$mname.'.'; ?> {{$lname}}</td>
            </tr>
            <tr>
              <td>Cash Price:</td>
              <td>${{$cashPriceOfProperty}}</td>
            </tr>
          </table>
        </section>
        <section>
          <p><b>The undersigned each verifies that all Property (as defined in the Lease Agreement with Option to Purchase (the “Lease”)), listed below has been received via delivery or has been made available for pickup as agreed.</b></p>
          <p><b>Retailer Name: </b>Big's Furniture</p>
          <p><b>List of Items Leased (the “Property”):</b></p>
          <p>1. {{$description}}</p>
          <p>Please note any damage, marks or imperfections to the Property: </p>
          <br />
          <p>Failure to note any damages, marks, or imperfections above indicates that the undersigned is satisfied with and unconditionally accepts the condition of the Property at the time of receipt.</p>
          <br />
          <p>Delivery Date: ______________________</p>
        </section>
        <!--<div class="page-break"></div>-->
        <section>
          <div class="tb-border clearfix">
            <table class="tbl-infor tbl-infor2">
              <tr>
                <td class="col-xs-6" style="border-right: solid 1px;">
                  <div class="row">
                    <div class="col-xs-10">
                      <p class="title">LESSEE:</p>
                      <br />
                      <hr class="line"/>
                      <p class="title">{{$fname}}<?php if(!empty($mname)) echo ' '.$mname.'.'; ?> {{$lname}}</p>
                    </div>
                  </div>
                </td>
                <td class="col-xs-6" style="vertical-align: top;">
                  <div class="row">
                    <div class="col-xs-10">
                      <p class="title">LESSOR:</p>
                      <br />
                      <hr class="line"/>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </section>
      </div>
    </div>
  </body>
</html> 