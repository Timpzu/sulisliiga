fetch('scripts/otteluhistoria.json')
  .then(response => {
    return response.json()
  })
  .then(data => {
    // Work with JSON data here
    console.log(data)
  })
  .catch(err => {
    // Do something for an error here
  })


let addPlayer = (nimi: string) => {
    let uusiPelaaja = {"name": nimi, "wins": 0, "losses": 0, "elo": 0};
    return uusiPelaaja;
}

let removePlayer = () => {
    console.log("jEA")
}

removePlayer()