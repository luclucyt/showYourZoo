//hey pls dont read this 
let logedin = false;

let username = "admin69";//aww men it said dont read :(
let password = "Password.123"//DUDE STOP IT (TдT) *crying noise here*

if(document.cookie.includes("loggedin")){
    //do nothing
}
else{
    document.cookie = "loggedin=" + "false"+ "; path=/"
    console.log(document.cookie)
}


//call this fuction when login btn is pressed
function login(){
    //sets the vars("let") to the input
    let UsernameSubmit = document.getElementById("usernameInput").value;
    let passwordSubmit = document.getElementById("passwordInput").value;

    //let me login
    if(UsernameSubmit == username && passwordSubmit == password){
        console.log(logedin)
        logedin = true;

        document.cookie = "loggedin=" + logedin + "; path=/"

        window.history.back(-1);
    }
    else{
        console.log(logedin)
        document.getElementById("error").style.display = "block";
        logedin = false;
        document.cookie = "loggedin=" + logedin + "; path=/"
    }
    
    console.log(document.cookie)
}