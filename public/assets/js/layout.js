// Headers scripts
function get(url, item){
    return fetch('/api/v1/'+url).then((response) => response.json()).then((response) => item = response.data).catch((err) => console.log(err))
}
// Main scripts
function post(url, paramNames, params, item){
    return fetch('/api/v1/'+url+'?'+paramNames+'='+params, { method: 'post', headers: {'Accept': 'application/json','Content-Type': 'application/json'}}).then((response) => response.json()).then(async(response) => item = response.data).catch((err) => console.log(err))
}
// Footer scripts
