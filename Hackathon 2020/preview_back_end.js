var arr=document.cookie.split(';')
for(var i=0; i<arr.length; i++){

    var c=arr[i].split('=');
    if (c[0].trim()=='name'){
        document.getElementById('name_1').innerHTML=decodeURIComponent(c[1])
    }
    else if(c[0].trim()=='ID No'){
        document.getElementById('org_number_1').innerHTML=decodeURIComponent(c[1])
    }
    else if(c[0].trim()=='Mobile No'){
        document.getElementById('ph_number_1').innerHTML=decodeURIComponent(c[1])
    }
    else if(c[0].trim()=='Email'){
        document.getElementById('email_1').innerHTML=decodeURIComponent(c[1])
    }
}

const image = localStorage.getItem("Image");
document.getElementById("image").src = image;

function goback(){

    window.location.href="front_end.html";
}

function register(){

    var d = new Date();
    d.setTime(d.getTime() + (2*60*1000));
    var expires = "expires ="+ d.toUTCString();

    document.cookie="name =" + document.getElementById("name_1").innerHTML + ";" + expires + ";path=/";
    document.cookie="ID No =" + document.getElementById("org_number_1").innerHTML + ";" + expires + ";path=/";
    document.cookie="Mobile No =" + document.getElementById('ph_number_1').innerHTML + ";" + expires + ";path=/";
    document.cookie="Email =" + document.getElementById('email_1').innerHTML + ";" + expires + ";path=/";
    document.cookie="Image =" + image + ";" + expires + ";path=/";
    window.location.href="database_registration.php"
}