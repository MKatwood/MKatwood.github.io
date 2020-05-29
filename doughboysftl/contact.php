 
    <!-- Conatct Us -->
    <section class="contact tri-white-top padding-top-100 padding-bottom-100" id="contact">
      <div class="container"> 
        
        <!-- Heading Block -->
        <div class="heading text-center"> <span>Get in Touch</span>
          <h3>Contact Us</h3>
          <hr>
          <i class="fa fa-bookmark-o"></i> </div>
        
        <!-- Conact Info -->
        <div class="contact-info">
          <ul>
            <li> <i class="fa fa-map-o"></i>
              <p>
							829 SE 17th St Causeway
							Ft Lauderdale FL 33316	
							</p>
            </li>
            <li> <i class="fa fa-phone"></i>
              <p>954-761-7652</p>
            </li>
            <li> <i class="fa fa-globe"></i>
              <p>http://www.doughboysftl.com/</p>
              <p> info@doughboysftl.com</p>
            </li>
            <li> <i class="fa fa-clock-o"></i>
              <p>Sun - Mon - Tues - Wed - Thurs: 10:30 AM - 10:30 PM</p>
              <p>Friday - Saturday: 10:30 AM - 2:00 AM</p>
            </li>
          </ul>
        </div>
        
        <!-- CONTACT FORM -->
        <div class="contact-form text-center">
          <div class="about-text text-center margin-top-80">
            <h1>send us a message </h1>
          </div>
          
          <!-- Success Msg -->
          <div id="contact_message" class="success-msg"> <i class="fa fa-paper-plane-o"></i>Thank You. Your Message has been Submitted</div>
          
          <!-- FORM -->
          <form role="form" id="contact_form" class="contact-form" method="post" onSubmit="return false">
            <ul class="row">
              <li class="col-sm-6">
                <label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Name *">
                </label>
              </li>
              <li class="col-sm-6">
                <label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email *">
                </label>
              </li>
              <li class="col-sm-6">
                <label>
                  <input type="text" class="form-control" name="company" id="company" placeholder="Phone no. *">
                </label>
              </li>
              <li class="col-sm-6">
                <label>
                  <input type="text" class="form-control" name="website" id="website" placeholder="Subject">
                </label>
              </li>
              <li class="col-sm-12">
                <label>
                  <textarea class="form-control" name="message" id="message" rows="5" placeholder="Your Message *"></textarea>
                </label>
              </li>
              <li class="col-sm-12 text-center">
                <button type="submit" value="submit" class="btn btn-round btn-dark btn-small" id="btn_submit" onClick="proceed();">Send Message</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </section>