function removeData(id){
    console.log("remove data working")
    contactList = JSON.parse(localStorage.getItem(listItem))|| []
    contactList = contactList.filter(function(value){
        return value.id!=id;
    });
    localStorage.setItem('listItem',JSON.stringify(contactList))
    allData()
}