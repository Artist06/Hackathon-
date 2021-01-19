// input text visibility based on checked state of checkboxes
function check(){

    if (document.getElementById("cb1").checked){
        document.getElementById("org_number").style.visibility="visible";
    }
    else{
        document.getElementById("org_number").style.visibility="hidden";
        document.getElementById("org_number").value="";
    }

    if (document.getElementById("cb2").checked){
        document.getElementById("ph_number").style.visibility="visible";
    }
    else{
        document.getElementById("ph_number").style.visibility="hidden";
        document.getElementById("ph_number").value="";
    }
}


//button color change based on input value length
function hovar(){

    var phone=document.getElementById("ph_number").value;
    var name=document.getElementById("name").value;
    var email=document.getElementById("email").value;
    var org_number=document.getElementById("org_number").value;
    var btn=document.getElementById("button");
    var file=document.getElementById("img").files[0];

    if (phone.length!=10 || name.length==0 || email.indexOf('@')==-1 || org_number.length==0 || file.size==0 || email.indexOf('.')==-1 ){
        btn.style.backgroundColor="lightsalmon"
    }
    else{
        btn.style.backgroundColor="chartreuse" 
        btn.style.color="black"
    }
}

function login(){
    //if number exists in database, change content of button from 'Register' to `Login`
}

//After clicking button    
var btn=document.getElementById("button");
function submit(){
    if (getComputedStyle(btn).backgroundColor == "rgb(127, 255, 0)"){
        var file = document.getElementById("img").files[0];
        const reader = new FileReader();
        reader.addEventListener("load", (event) => {
            //localStorage.setItem("image_name", event.target.fileName);
            localStorage.setItem("image", event.target.result);
            localStorage.setItem("img", document.getElementById("img").files[0].name);
            localStorage.setItem("name", document.getElementById("name").value);
            localStorage.setItem("id", document.getElementById("org_number").value);
            localStorage.setItem("contact", document.getElementById("ph_number").value);
            localStorage.setItem("email", document.getElementById("email").value);
            window.location.href = "preview.html";
        });
        reader.readAsDataURL(file);
    }
}