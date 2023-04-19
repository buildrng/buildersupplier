// Headers scripts
function get(url, item){
    this.isLoading = true;
    fetch('/api/v1/'+url)
    .then((response) => response.json())
    .then((response) => (item = response.data))
    .catch((err) => console.log(err));
};
// Main scripts
function post(url, params, item){
    this.isLoading = true;
    fetch.post('/api/v1/'+url,{params})
    .then((response) => response.json())
    .then((response) => (item = response.data))
    .catch((err) => console.log(err));
}
// Footer scripts
