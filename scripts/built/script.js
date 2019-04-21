fetch('scripts/otteluhistoria.json')
    .then(function (response) {
    return response.json();
})
    .then(function (data) {
    console.log(data);
})["catch"](function (err) {
});
var addPlayer = function (nimi) {
    var uusiPelaaja = { "name": nimi, "wins": 0, "losses": 0, "elo": 0 };
    return uusiPelaaja;
};
var removePlayer = function () {
    console.log("jEA");
};
removePlayer();
//# sourceMappingURL=script.js.map