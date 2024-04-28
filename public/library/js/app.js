// Function to create a dropdown with search
const createDropdown = (selectElement) => {
	const container = selectElement.parentElement;
	const data = Array.from(selectElement.options).map(option => option.textContent);
	const selectClasses = selectElement.classList;
	selectClasses.remove("convert-to-dropdown"); // Remove class to prevent duplicate conversion
	// Get width of select element
	const selectWidth = selectElement.offsetWidth;
	// Get classes of select element
	const selectClassList = selectElement.classList;
	const selectId = selectElement.id;
	const selectedValue = selectElement.options[selectElement.selectedIndex].value;
	console.log(selectedValue);
	const hiddenInput = document.createElement('input');
	hiddenInput.type = 'hidden';
	hiddenInput.name = `${selectId}-attributes`;
	// Copy all attributes from select element to hidden input
	for (const attr of selectElement.attributes) {
		hiddenInput.setAttribute(attr.name, attr.value);
	}
	hiddenInput.value = selectedValue;
	hiddenInput.dispatchEvent(new Event('input')); // Dispatch change event to hidden input
	container.innerHTML = `
<div class="relative">
	<input type="text" id="search_${selectId}" class="${[...selectClassList].join(' ')}" placeholder="Search..." value="${selectedValue}" style="width: ${selectWidth}px;">
	<div id="dropdown${selectId}" class="absolute z-10 mt-2 w-full rounded-md bg-white shadow-lg hidden" style="width: ${selectWidth}px;">
		<!-- Dropdown items will be inserted here -->
	</div>
</div>
`;
	container.appendChild(hiddenInput);
	const searchInput = container.querySelector('#search_' + selectId);
	const dropdown = container.querySelector('#dropdown' + selectId);
	// Function to filter dropdown items based on search query
	const filterDropdown = (query) => {
		return data.filter(item => item.toLowerCase().includes(query.toLowerCase()));
	};
	// Function to render dropdown items
	const renderDropdownItems = (items) => {
		dropdown.innerHTML = ''; // Clear previous items
		items.forEach(item => {
			const div = document.createElement('div');
			div.textContent = item;
			div.classList.add('py-2', 'px-4', 'cursor-pointer', 'hover:bg-gray-100');
			div.addEventListener('click', () => {
				searchInput.value = item; // Set selected item to input value
				dropdown.classList.add('hidden'); // Hide dropdown after selecting an item
				hiddenInput.value = item;
				hiddenInput.dispatchEvent(new Event('input')); // Dispatch change event to hidden input
			});
			dropdown.appendChild(div);
		});
	};
	// Event listener for input field to update dropdown items on input
	searchInput.addEventListener('input', (e) => {
		const query = e.target.value;
		const filteredItems = filterDropdown(query);
		renderDropdownItems(filteredItems);
		// Show or hide dropdown based on query length
		if (query.length > 0 && filteredItems.length > 0) {
			dropdown.classList.remove('hidden');
		} else {
			dropdown.classList.add('hidden');
		}
	});
	// Event listener for input field to show dropdown on click
	searchInput.addEventListener('click', () => {
		dropdown.classList.remove('hidden');
	});
	// Event listener to hide dropdown when focus leaves input field
	searchInput.addEventListener('blur', () => {
		setTimeout(() => {
			dropdown.classList.add('hidden');
		}, 200); // Add a slight delay to allow click on dropdown items to trigger before closing dropdown
	});
	// Initial render of dropdown items
	renderDropdownItems(data);
};
// Function to convert all select tags with class "convert-to-dropdown" to dropdowns
const convertSelectsToDropdowns = () => {
	const selectElements = document.querySelectorAll('.convert-to-dropdown');
	selectElements.forEach(selectElement => {
		createDropdown(selectElement);
	});
};
// Call the function to convert select tags to dropdowns
convertSelectsToDropdowns();