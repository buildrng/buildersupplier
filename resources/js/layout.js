// Headers scripts
function getcategories(){
    this.isLoading = true;
    fetch('/api/v1/category/getHome/')
    .then((response) => response.json())
    .then((response) => (this.categories = response.data))
    .catch((err) => console.log(err));
}
// Main scripts

// Footer scripts
