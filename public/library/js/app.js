// Function to create a dropdown with search
const createDropdown = (selectElement) => {
	const container = selectElement.parentElement;
	const data = Array.from(selectElement.options).map(option => option);
	const selectClasses = selectElement.classList;
	selectClasses.remove("convert-to-dropdown"); // Remove class to prevent duplicate conversion
	// Get width of select element
	let selectWidth = selectElement.offsetWidth;
	if(selectWidth === 0) {
		selectWidth = "100%"; // Set width to 100% if it is 0
	}
	// Get classes of select element
	const selectClassList = selectElement.classList;
	const selectId = selectElement.id;
	const selectedValue = selectElement.options[selectElement.selectedIndex].value;
	const selectedText = selectElement.options[selectElement.selectedIndex].textContent;
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
			<input type="text" id="search_${selectId}" class="${[...selectClassList].join(' ')}" placeholder="Search..." value="${selectedText}" style="width: ${selectWidth}; padding-right: 20px;">
			<div id="dropdown${selectId}" class="absolute z-10 mt-2 w-full rounded-md bg-white shadow-lg hidden text-sm" style="width: ${selectWidth};">
				<!-- Dropdown items will be inserted here -->
			</div>
			<svg class="absolute right-0 top-2 mt-0.5 mr-2 pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<path d="M7 10l5 5 5-5"></path>
			</svg>
		</div>
		`;
	container.appendChild(hiddenInput);
	const searchInput = container.querySelector('#search_' + selectId);
	const dropdown = container.querySelector('#dropdown' + selectId);
	// Function to filter dropdown items based on search query
	const filterDropdown = (query) => {
		return data.filter((item) => {
			if(item.innerText.toLowerCase().includes(query.value.toLowerCase())){
				return item
			}
		});
	};
	// Function to render dropdown items
	const renderDropdownItems = (items) => {
		dropdown.innerHTML = ''; // Clear previous items
		items.forEach(item => {
			const div = document.createElement('div');
			div.textContent = item.innerText;
			div.classList.add('py-1', 'px-3', 'cursor-pointer', 'hover:bg-gray-100');
			div.addEventListener('click', () => {
				searchInput.value = item.innerText; // Set selected item to input value
				dropdown.classList.add('hidden'); // Hide dropdown after selecting an item
				hiddenInput.value = item.value;
				hiddenInput.dispatchEvent(new Event('input')); // Dispatch change event to hidden input
				hiddenInput.dispatchEvent(new Event('change')); // Dispatch change event to hidden input
			});
			dropdown.appendChild(div);
		});
	};
	// Event listener for input field to update dropdown items on input
	searchInput.addEventListener('input', (e) => {
		const query = e.target;
		const filteredItems = filterDropdown(query);
		renderDropdownItems(filteredItems);
		// Show or hide dropdown based on query length
		if (query.value.length > 0 && filteredItems.length > 0) {
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
window.onload = convertSelectsToDropdowns;