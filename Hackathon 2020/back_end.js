

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

    if (phone.length!=10 || name.length==0 || email.indexOf('@')==-1 || org_number.length==0 || file.size==0){
        btn.style.backgroundColor="lightsalmon"
    }
    else{
        btn.style.backgroundColor="chartreuse" 
        btn.style.color="black"
    }
}



//After clicking button    
var btn=document.getElementById("button");
function submit(){
if (getComputedStyle(btn).backgroundColor == "rgb(127, 255, 0)"){
    var d = new Date();
    d.setTime(d.getTime() + (2*60*1000));
    var expires = "expires ="+ d.toUTCString();

    
        document.cookie="name =" + document.getElementById("name").value + ";" + expires + ";path=/";
        document.cookie="ID No =" + document.getElementById("org_number").value + ";" + expires + ";path=/";
        document.cookie="Mobile No =" + document.getElementById("ph_number").value + ";" + expires + ";path=/";
        document.cookie="Email =" + document.getElementById("email").value + ";" + expires + ";path=/";
        var file = document.getElementById("img").files[0];
        const reader = new FileReader();
        reader.addEventListener("load", (event) => {
            localStorage.setItem("Image", event.target.result);
            window.location.href = "preview.html";
        });
        reader.readAsDataURL(file);
        }
}