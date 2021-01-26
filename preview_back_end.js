document.getElementById("go").addEventListener('click',submit);
function submit(){
    const dForm = document.getElementById('details');          
    dForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetch("database_registration.php",{
        method: "post",
        body:JSON.stringify({'name': localStorage.getItem("name"),
                            'contact': localStorage.getItem("contact"),
                            'email': localStorage.getItem("email"),
                            'id_no': localStorage.getItem("id"),
                            'image': localStorage.getItem("img")}),
        headers: {'Accept': 'application/json',
                  'Content-Type': 'application/json',
                  'Access-Control-Allow-Headers': '*',
                  'Access-Control-Allow-Origin': '*',
                  'Access-Control-Allow-Methods': 'GET, POST, HEAD, OPTIONS'
                 },
        }).then(function (response){
            return response.text();
        }).then(function (text){
            document.getElementById("response").innerHTML=text;
        }).catch(function (error){
            console.error(error);
        })
    });
}

document.getElementsByName("image")[0].src=localStorage.getItem("image");
document.getElementsByName("name_1")[0].innerHTML=localStorage.getItem("name");
document.getElementsByName("org_number_1")[0].innerHTML=localStorage.getItem("id");
document.getElementsByName("ph_number_1")[0].innerHTML=localStorage.getItem("contact");
document.getElementsByName("email_1")[0].innerHTML=localStorage.getItem("email");

function goback(){

    window.location.href="front_end.html";
}
