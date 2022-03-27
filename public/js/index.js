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
                    <button type="button" class="edit-button" data-id="${contact.id}">Edit</button>

                </div>`;    
			});
			addDeleteEvent();
			addEditEvent();
			addSubmitEvent();
		})
	})
}


const addDeleteEvent = () => {
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
}


const addEditEvent = () => {
	const editButtons = document.getElementsByClassName("edit-button");
	for(let editButton of editButtons) {
		editButton.addEventListener("click", (event) =>{
			fetch(`/api/contacts/${editButton.dataset.id}`, {
				method: 'get'
			})
			.then(response => response.json())
			.then(data => {
				const editForm = document.forms["edit-form"];
				editForm.id.value = data.id;
				editForm.name.value = data.name;
				editForm.phone.value = data.phone;
				editForm.address.value = data.address;
				editForm.color.value = data.favorites.colors.join(", "); 
				const formArea = document.getElementsByClassName("edit-form")[0];
				formArea.style.display = "block";
				const searchArea = document.getElementsByClassName("search-area")[0];
				searchArea.style.display = "none";
			})
		})
	}
}




const addSubmitEvent = () => {
	const form = document.forms["edit-form"];
	const submitButton = form["submit-button"];
	submitButton.addEventListener("click", (event) =>{
		// We need to grab the id here.
		const idInput = form.id
		const body = {
			"name": form.name.value,
			"address": form.address.value,
			"phone": form.phone.value,
			"color": form.color.value
		}
		fetch(`/api/contacts/${idInput.value}`, {
			method: 'put',
			body: JSON.stringify(body),
			headers: { 'Content-Type': 'application/json' }
		}).then(response => {
			return response.json()
		}).then(data => {
			form.reset();
			const formArea = document.getElementsByClassName("edit-form")[0];
			formArea.style.display = "none";
			const searchArea = document.getElementsByClassName("search-area")[0];
			searchArea.style.display = "block";
		})
	})
}


