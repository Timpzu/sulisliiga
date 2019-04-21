fetch('scripts/otteluhistoria.json')
    .then(function (response) {
    return response.json();
})
    .then(function (data) {
    // Work with JSON data here
    console.log(data);
})["catch"](function (err) {
    // Do something for an error here
});
var addPlayer = function (nimi) {
    var uusiPelaaja = { "name": nimi, "wins": 0, "losses": 0, "elo": 0 };
    return uusiPelaaja;
};
var removePlayer = function () {
    console.log("jEA");
};
removePlayer();
