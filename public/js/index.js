const pageloaded = () => {
	const searchbar = document.getElementById("search-input");
	searchbar.addEventListener("keyup", (event) => {
		fetch(`/api/contacts/?search=${searchbar.value}`)
		.then(response => response.json())
		.then(data => {
			const searchArea = document.getElementById("search-area");
			searchArea.innerHTML = "";
			data.forEach(contact => {
				searchArea.innerHTML += 
				`<div class="pa2 mb3 striped--near-white">         
                    <header class="b mb2">${contact.name}</header>
                    <div class="pl2">                         
                        <p class="mb2">${contact.phone }</p>       
                        <p class="pre mb3">${contact.address}</p>
                        <p class="mb2"><span class="fw5">Favorite colors:</span> ${ contact.favorites['colors'].join(", ") }</p>                     
                    </div>  
                    <button type="button" class="delete-button" data-id="${contact.id}">Delete</button>               
                </div>`;    
			});
			const deleteButtons = document.getElementsByClassName("delete-button");
			for(let deleteButton of deleteButtons) {
				deleteButton.addEventListener("click", (event) =>{
					fetch(`/api/contacts/${deleteButton.dataset.id}`, {
						method: 'delete'
					})
					.then(response => response.json())
					.then(data => {
						deleteButton.closest('div').remove();
					})

				});

			}
		})
	})
}