// Headers scripts

async function get(url, item){
    return await fetch('/api/v1/'+url).then((response) => response.json()).then((response) => item = response.data).catch((err) => console.log(err))
}
// Main scripts

// Footer scripts
