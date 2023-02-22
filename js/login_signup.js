//Jquery import
var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
document.getElementsByTagName('head')[0].appendChild(script);

const login = "<form action=\"php/login.php\" method=\"post\">\n" +
    "                <div class=\"form-group\">\n" +
    "                    <label for=\"email\">Email address:</label>\n" +
    "                    <input type=\"email\" class=\"form-control\" name=\"email_login\" id=\"email_login\" placeholder=\"max.musterman@mail.com\" required>\n" +
    "                </div>\n" +
    "                <div class=\"form-group\">\n" +
    "                    <label for=\"pwd\">Password:</label>\n" +
    "                    <input type=\"password\" class=\"form-control\" name=\"pwd_login\" id=\"pwd_login\" required>\n" +
    "                </div>\n" +
    "                <button type=\"submit\" class=\"btn btn-default\">Submit</button>\n" +
    "            </form>";

const signup = "<form action=\"php/signup.php\" method=\"post\">\n" +
    "    <div class=\"form-group col-md-6\">\n" +
    "        <label for=\"text\">Surname:</label>\n" +
    "        <input type=\"text\" class=\"form-control\" name=\"surname_signup\" id=\"surname_signup\" placeholder=\"Max\" required>\n" +
    "    </div>\n" +
    "    <div class=\"form-group col-md-6\">\n" +
    "        <label for=\"text\">Name:</label>\n" +
    "        <input type=\"text\" class=\"form-control\" name=\"name_signup\" id=\"name_signup\" placeholder=\"Musterman\" required>\n" +
    "    </div>\n" +
    "    <div class=\"form-group\">\n" +
    "        <label for=\"text\">Username:</label>\n" +
    "        <input type=\"text\" class=\"form-control\" name=\"username_signup\" id=\"username_signup\" placeholder=\"MaximusMusterius\" required>\n" +
    "    </div>\n" +
    "    <div class=\"form-group col-md-6\">\n" +
    "        <label for=\"text\">Password:</label>\n" +
    "        <input type=\"password\" class=\"form-control\" name=\"pwd_signup\" id=\"pwd_signup\" placeholder=\"Password1234\" required>\n" +
    "    </div>\n" +
    "    <div class=\"form-group col-md-6\">\n" +
    "        <label for=\"text\">Password again:</label>\n" +
    "        <input type=\"password\" class=\"form-control\" name=\"pwd_again_signup\" id=\"pwd_again_signup\" placeholder=\"Password1234\" required>\n" +
    "    </div>\n" +
    "    <div class=\"form-group col-md-6\">\n" +
    "        <label for=\"text\">EMail:</label>\n" +
    "        <input type=\"email\" class=\"form-control\" name=\"email_signup\" id=\"email_signup\" placeholder=\"max.musterman@mail.com\" required>\n" +
    "    </div>\n" +
    "    <div class=\"form-group col-md-6\">\n" +
    "        <label for=\"text\">Telefon:</label>\n" +
    "        <input type=\"text\" class=\"form-control\" name=\"telefon_signup\" id=\"telefon_signup\" placeholder=\"+43 665 2453876\">\n" +
    "    </div>\n" +
    "    <div class=\"form-group\">\n" +
    "        <input type=\"checkbox\" name=\"creator_signup\" id=\"creator_signup\" onclick=\"creator()\">\n" +
    "        <label for=\"creator_signup\">Creator?</label>\n" +
    "    </div>\n" +
    "    <div id=\"signup_div\" class=\"form-group\">\n" +
    "        <div class=\"form-group\">\n" +
    "            <label for=\"birthday_signup\">Bithday:</label>\n" +
    "            <input type=\"date\" class=\"form-control\" name=\"bithday_signup\" id=\"birthday_signup\">\n" +
    "        </div>\n" +
    "    </div>\n" +
    "    <div id=\"creator_signup_div\" style=\"display:none\" class=\"form-group\">\n" +
    "        <div class=\"form-group\">\n" +
    "            <label for=\"typ_signup\">Typ:</label>\n" +
    "            <select class=\"form-control\" id=\"typ_signup\" onchange=\"document.getElementById('typ').value=this.options[this.selectedIndex].text\">\n" +
    "                <option value=\"0\">Painter</option>\n" +
    "                <option value=\"1\">Musician</option>\n" +
    "                <option value=\"2\">Programmer</option>\n" +
    "                <option  value=\"3\">Photographer</option>\n" +
    "                <option  value=\"4\">Moviemaker</option>\n" +
    "                <option  value=\"5\">Author</option>\n" +
    "            </select>\n" +
    "            <input type=\"hidden\" name=\"typ\" id=\"typ\" value=\"\" />\n" +
    "        </div>\n" +
    "        <div class=\"form-group\">\n" +
    "            <label for=\"description_signup\">Desciption:</label>\n" +
    "            <textarea class=\"form-control\" name=\"description_signup\" id=\"description_signup\"></textarea>\n" +
    "        </div>\n" +
    "    </div>\n" +
    "    <button type=\"submit\" class=\"btn btn-default\">Submit</button>\n" +
    "</form>";

function import_login(){
    $("#login").removeClass("btn-default");
    $("#login").addClass("btn-primary");
    $("#signup").removeClass("btn-primary");
    $("#signup").addClass("btn-default");
    document.getElementById("form").innerHTML = login;
    document.getElementById("title_text").innerText = "Login";
}

function import_signup(){
    $("#login").removeClass("btn-primary");
    $("#login").addClass("btn-default");
    $("#signup").removeClass("btn-default");
    $("#signup").addClass("btn-primary");
    document.getElementById("form").innerHTML = signup;
    document.getElementById("title_text").innerText = "Signup";

}

function creator(){
    if(document.getElementById("creator_signup").checked == true){
        document.getElementById("creator_signup_div").style.display="block";
        document.getElementById("signup_div").style.display="none";
    }
    else
    {
        document.getElementById("signup_div").style.display="block";
        document.getElementById("creator_signup_div").style.display="none";
    }
}

/*
            <form action="php/login.php" method="post">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" name="email_login" id="email_login" placeholder="max.musterman@mail.com" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="pwd_login" id="pwd_login" required>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
*/

/*
          <form action="php/signup.php" method="post">
                <div class="form-group col-md-6">
                    <label for="text">Surname:</label>
                    <input type="text" class="form-control" name="surname_signup" id="surname_signup" placeholder="Max" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="text">Name:</label>
                    <input type="text" class="form-control" name="name_signup" id="name_signup" placeholder="Musterman" required>
                </div>
                <div class="form-group">
                    <label for="text">Username:</label>
                    <input type="text" class="form-control" name="username_signup" id="username_signup" placeholder="MaximusMusterius" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="text">Password:</label>
                    <input type="password" class="form-control" name="pwd_signup" id="pwd_signup" placeholder="Password1234" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="text">Password again:</label>
                    <input type="password" class="form-control" name="pwd_again_signup" id="pwd_again_signup" placeholder="Password1234" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="text">EMail:</label>
                    <input type="email" class="form-control" name="email_signup" id="email_signup" placeholder="max.musterman@mail.com" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="text">Telefon:</label>
                    <input type="text" class="form-control" name="telefon_signup" id="telefon_signup" placeholder="+43 665 2453876">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="creator_signup" id="creator_signup" onclick="creator()">
                    <label for="creator_signup">Creator?</label>
                </div>
                <div id="signup_div" class="form-group">
                    <div class="form-group">
                        <label for="text">Birthday:</label>
                        <input type="date" class="form-control" name="bithday_signup" id="birthday_signup">
                    </div>
                </div>
               <!-- <div id="creator_signup_div" style="display:none" class="form-group">
                    <div class="form-group">
                        <label for="typ_signup">Typ:</label>
                        <select class="form-control" id="typ_signup" onchange="document.getElementById('typ').value=this.options[this.selectedIndex].text">
                            <option value="0">Painter</option>
                            <option value="1">Musician</option>
                            <option value="2">Programmer</option>
                            <option  value="3">Photographer</option>
                            <option  value="4">Moviemaker</option>
                            <option  value="5">Author</option>
                        </select>
                        <input type="hidden" name="typ" id="typ" value="" />
                    </div>-->
                    <div class="form-group">
                        <label for="description_signup">Desciption:</label>
                        <textarea class="form-control" name="description_signup" id="description_signup"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
*/