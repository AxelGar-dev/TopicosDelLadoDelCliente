function User(forename, username, password) {
    this.forename = forename;
    this.username = username;
    this.password = password;

    this.showUser = function() {
        document.write("Forename: "+ this.forename + "<br>");
        document.write("Username: "+ this.username + "<br>");
        document.write("Password: "+ this.password + "<br>");
    }
}

let user = new User("Wolfgang", "w.a.mozart", "composer");

user.showUser();

let array = [1, 2, 3, 4, 5];
let arreglo = [];
arreglo.push("Elemento 1");
arreglo[1] = "Elemento 2";

//Muestra "Elemento 2"
arreglo.pop();
//Muestra "Elemento 1"
arreglo[0];

let jugadoresNBA = {
    "MichaelJordan": "Chicago Bulls",
    "KobeBrayant": "Los Ángeles Lakers",
    "LeBron James": "Cleveland",
    "StephenCurry": "Golden State Warriors"
}

//Devolverá "Chicago Bulls"
jugadoresNBA["MichaelJordan"];

let matriz = [
    [0, 0, 0, 1, 0, 0],
    [0, 0, 1, 0, 0, 0],
    [0, 1, 0, 0, 0, 0],
    [1, 0, 0, 0, 0, 0]
]

//Esto entrará en la primera matriz, en la posición 4
//Y devolverá el 1 que se ve en la matriz de a primera
//Fila
matriz[0][3];