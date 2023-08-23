
    <div class="section CareerFormBg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-12">
                    <div class="ApplyFormMain">
                        <div class="LeaveCommentMain">
                            <div class="LeaveForm">
                                <form action="career_email" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-12">
                                            <div class="applyText">
                                                <span>Apply now <img src="images/circlered.png" alt=""></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="First Name:" id="first_name" name="first_name">
                                                <small class="forerror"> Error Message </small>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Last Name:" id="last_name" name="last_name">
                                                <small class="forerror"> Error Message </small>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Email Address:" name="email" id="email">
                                                <small class="forerror"> Error Message </small>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Phone Number:" name="phone" id="phone">
                                                <small class="forerror"> Error Message </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Position Applying For:" name="position" id="position">
                                                    <small class="forerror"> Error Message </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group ChooseFile2">
                                                <div class="ChooseFile">
                                                    <input type="file" class="file-browser" name="file">
                                                </div>
                                                <small class="forerror2"> Error Message </small>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <textarea class="form-control"
                                                    placeholder="Write your comment" name="message" id="message">
                                                </textarea>
                                                <small class="forerror"> Error Message </small>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" onclick="return handleInput()" name="submit"  value="Submit">Submit</button>
                                        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	</div>

<script>

class FileChooser {
  constructor(element, settings) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    this.settings = FileChooser.getSettings(settings);
    this.originalInput = element;
    this.wrapper = FileChooser.createWrapper();
    this.input = FileChooser.createInput(this.settings.placeholder);
    this.clearButton = FileChooser.createClearButton();

    this.appendElements();
    this.attachListeners();
  }
  setText(text) {
    this.input.value = text;
  }
  reset() {
    this.wrapper.reset();
  }
  open() {
    this.originalInput.click();
  }
  attachListeners() {
    this.wrapper.addEventListener('click', ev => {
      ev.preventDefault();
      this.open();
    });
    this.wrapper.addEventListener('submit', ev => ev.preventDefault());

    this.clearButton.addEventListener('click', ev => {
      ev.stopPropagation();
      this.reset();
    });

    this.originalInput.addEventListener('click', ev => ev.stopPropagation());

    this.originalInput.addEventListener('change', ev => {
      this.setText(ev.target.value);
    });
  }
  appendElements() {
    let parent = this.originalInput.parentNode;

    this.originalInput.classList.add('file-chooser-hidden');
    this.wrapper.appendChild(this.input);
    this.wrapper.appendChild(this.clearButton);
    parent.insertBefore(this.wrapper, this.originalInput);
    this.wrapper.appendChild(this.originalInput);
  }
  static getDefaults() {
    return {
      buttonText: 'UPLOAD',
      placeholder: 'Attach Resume/CV:' };

  }
  static getSettings(settings) {
    return {
      ...FileChooser.getDefaults(),
      ...settings };

  }
  static createWrapper() {
    let wrapper = document.createElement('form');
    wrapper.classList.add('file-chooser');
    return wrapper;
  }
  static createInput(placeholder) {
    let input = document.createElement('input');
    input.setAttribute('readonly', true);
    input.setAttribute('placeholder', placeholder);
    input.classList.add('file-chooser-input');
    return input;
  }
  static createClearButton() {
    let clearButton = document.createElement('button');
    clearButton.classList.add('file-chooser-clear');
    return clearButton;
  }}


let fileBorwser = new FileChooser('.file-browser', {});
let fileBrowser2 = new FileChooser('.file-browser-2', {});  
</script>


<script>

    let first_name = document.querySelector("#first_name");
    let last_name = document.querySelector("#last_name");
    let email = document.querySelector("#email");
    let phone = document.querySelector("#phone");
    let position = document.querySelector("#position");
    let message = document.querySelector("#message");
    let fileInput = document.getElementsByName("file")[0];
        
    function handleInput() {
        
      // Values from dom elements ( input )
      let first_nameValue = first_name.value.trim();
      let last_nameValue = last_name.value.trim();
      let emailValue = email.value.trim();
      let phoneValue = phone.value.trim();
      let positionValue = position.value.trim();
      let messageValue = message.value.trim();
    
      //  Checking for first_name
          if (first_nameValue === "") {
            setErrorFor(first_name, "First Name field is required");
            return false;
          }

      //  Checking for last_name
          if (last_nameValue === "") {
            setErrorFor(last_name, "Last Name field is required");
            return false;
          }         
    
          // Checking for email
          if (emailValue === "") {
            setErrorFor(email, "Email field is required");
               return false;
          } else if (!isEmail(emailValue)) {
            setErrorFor(email, "Email is not valid");
               return false;
          }
          
          if (phoneValue === "") {
            setErrorFor(phone, "Phone: field is required");
            return false;
          }
          if (positionValue === "") {
            setErrorFor(position, "Position field is required");
            return false;
          }         
          
          if(!fileInput.value) {
              setErrorForFile(fileInput, "File Field is required");
              return false;
          }
            
            if (!validateFileExtension(fileInput)) {
            setErrorForFile(fileInput, "Only .docx, .pdf, .jpeg, .jpg, and .png files are allowed");
            return false;
        }    
            
          if (messageValue === "") {
            setErrorFor(message, "Message field is required");
            return false;
          }
          
          return true;
          
    }
    
    function validateFileExtension(input) {
        const allowedExtensions = [".docx", ".pdf", ".jpeg", ".jpg", ".png"];
        const fileName = input.value;
        const fileExtension = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
        return allowedExtensions.includes(fileExtension);
    }
    
    function setErrorForFile(input, message) {
    let formvalidate = input.parentElement;
    let formvalidatepar =  formvalidate.parentElement 
    formvalidatepar.className = "form-group ChooseFile2 error";
    let small = formvalidatepar.querySelector("small");
    small.innerText = message;
    }
    
    function setErrorFor(input, message) {
    let formvalidate = input.parentElement;
    formvalidate.className = "form-group forerrorrelative error";
    let small = formvalidate.querySelector("small");
    small.innerText = message;
    }
</script>