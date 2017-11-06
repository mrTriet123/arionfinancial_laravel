<div class="view-infor" id="view-infor">
  <div class="wrap-infor">
    <div class="u-name">
      <h4>BIG'S furniture</h4>
    </div>
    <div class="mid-inf">
      <div class="mid-inf-part mid-inf-left">
        <h3>Activity</h3>
        <div class="calcu-wrap">
          <div class="calcu-wrap-part calcu-wrap-left">
            <h2>${{$balance}}</h2>
            <p>Current Blance</p>
          </div>
          <div class="calcu-wrap-part calcu-wrap-right">
            <h2>${{$last_pay}}</h2>
            <p>Last Payment</p>
          </div>
        </div>
        <div class="link-view">
          <a href="#" class="view-act btn-view">View Activity</a>
          <p><a href="/Statements" class="view-state">View-Statements</a></p>
        </div>
      </div>
      <div class="mid-inf-part">
        <h3>Payment</h3>
        <div class="calcu-wrap">
          <div class="calcu-wrap-part calcu-wrap-left">
            <h2>${{$minimum_pay}}</h2>
            <p>Minimum Pay Due</p>
          </div>
          <div class="calcu-wrap-part calcu-wrap-right">
            <h2>{{$date2}}</h2>
            <p>Next Payment Due Date</p>
          </div>
        </div>
        <div class="link-view">
          <a href="#" class="view-act btn-view">View Payments</a>
        </div>
      </div>
      <div class="inf-text">
        <p><i><img src="../public/images/icon_card.png"></i>Your next payment of {{$minimum_pay_next}} is due on({{$date3}})</p>
      </div>

       <div class="footer-inf">
          <a href="/Account" class="acc-details">Account Details</a>
          <a href="/Statements" class="state">Statements</a>
      </div>
      <p class="foot-text">*May not reflect recent transactions</p>
    </div>
  </div>
</div>

