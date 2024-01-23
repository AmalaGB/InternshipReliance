
function populateDropdown(selectElement, options, defaultText = 'Select') {
  selectElement.innerHTML = '';

  let defaultOption = document.createElement('option');
  defaultOption.value = '';
  defaultOption.textContent = defaultText;
  selectElement.appendChild(defaultOption);

  options.forEach(option => {
    let opt = document.createElement('option');
    opt.value = option.id;
    opt.textContent = option.name;
    selectElement.appendChild(opt);
  });
}

function filterOptions(optionsArray, filterKey, filterValue) {
  return optionsArray.filter(option => option[filterKey] == filterValue);
}

fetch('load1_data.php')
.then(response => {
  if (!response.ok) {
    throw new Error(`HTTP error! Status: ${response.status}`);
  }
  return response.json();
})
.then(data => {
  console.log('Received data:', data);


    let majorSelect = document.getElementById('majorclassificationmaster');
    populateDropdown(majorSelect, data.major, 'Select Major');

    let submajorSelect = document.getElementById('submajorclassificationmaster');
    populateDropdown(submajorSelect, data.submajor_trydb.concat(data.submajor_qna), 'Select Submajor');


   let categorySelect = document.getElementById('categorymaster');
    populateDropdown(categorySelect, data.category, 'Select Category');

    let subcategorySelect = document.getElementById('subcategorymaster');
    populateDropdown(subcategorySelect, data.subcategory, 'Select Subcategory');

    let itemTypeSelect = document.getElementById('itemtypemaster');
    populateDropdown(itemTypeSelect, data.itemtype, 'Select Item Type');

    let itemSelect = document.getElementById('itemmaster');
    populateDropdown(itemSelect, data.item, 'Select Item');

       let seasonSelect = document.getElementById('seasonmaster');
       populateDropdown(seasonSelect, data.season, 'Select Season');


    majorSelect.addEventListener('change', () => {
      let selectedMajor = majorSelect.value;
      console.log('Selected Major:', selectedMajor);
    
      if (data.submajor && Array.isArray(data.submajor)) {
        let submajorOptions = filterOptions(data.submajor, 'majorId', selectedMajor);
        console.log('Filtered submajor options:', submajorOptions);
    
        if (submajorSelect) {
          populateDropdown(submajorSelect, submajorOptions, 'Select Submajor');
        } else {
          console.error('Error: submajorSelect is not found or is undefined.');
        }
      } else {
        console.error('Error: data.submajor is not an array or is undefined.');
      }
    });
    
    // Populate category on submajor change
    submajorSelect.addEventListener('change', () => {
      let selectedSubmajor = submajorSelect.value;
      console.log('Selected Submajor:', selectedSubmajor);

      if (data.category && Array.isArray(data.category)) {
        let categoryOptions = filterOptions(data.category, 'submajorId', selectedSubmajor);
        console.log('Filtered category options:', categoryOptions);

        // Check if categorySelect exists and has options
        if (categorySelect) {
          populateDropdown(categorySelect, categoryOptions, 'Select Category');
        } else {
          console.error('Error: categorySelect is not found or is undefined.');
        }
      } else {
        console.error('Error: data.category is not an array or is undefined.');
      }
    });

    console.log('Subcategory options:', data.subcategory);

    // Populate subcategory on category change
    categorySelect.addEventListener('change', () => {
      let selectedCategory = categorySelect.value;
      console.log('Selected Category:', selectedCategory);

      if (data.subcategory && Array.isArray(data.subcategory)) {
        let subcategoryOptions = filterOptions(data.subcategory, 'categoryId', selectedCategory);
        console.log('Filtered subcategory options:', subcategoryOptions);

        // Check if subcategorySelect exists and has options
        if (subcategorySelect) {
          populateDropdown(subcategorySelect, subcategoryOptions);
        } else {
          console.error('Error: subcategorySelect is not found or is undefined.');
        }
      } else {
        console.error('Error: data.subcategory is not an array or is undefined.');
      }
    });

    // Populate item type on submajor change
    submajorSelect.addEventListener('change', () => {
      let selectedSubmajor = submajorSelect.value;
      console.log('Selected Submajor:', selectedSubmajor);

      if (data.itemtype && Array.isArray(data.itemtype)) {
        let itemTypeOptions = filterOptions(data.itemtype, 'submajorId', selectedSubmajor);
        console.log('Filtered item type options:', itemTypeOptions);

        // Check if itemTypeSelect exists and has options
        if (itemTypeSelect) {
          populateDropdown(itemTypeSelect, itemTypeOptions);
        } else {
          console.error('Error: itemTypeSelect is not found or is undefined.');
        }
      } else {
        console.error('Error: data.itemtype is not an array or is undefined.');
      }
    });

    // Log data for debugging
    console.log('Item options:', data.item);

    // Populate item on item type change
    itemTypeSelect.addEventListener('change', () => {
      let selectedItemType = itemTypeSelect.value;
      console.log('Selected Item Type:', selectedItemType);

      if (data.item && Array.isArray(data.item)) {
        let itemOptions = filterOptions(data.item, 'itemtypeId', selectedItemType);
        console.log('Filtered item options:', itemOptions);

        // Check if itemSelect exists and has options
        if (itemSelect) {
          populateDropdown(itemSelect, itemOptions);
        } else {
          console.error('Error: itemSelect is not found or is undefined.');
        }
      } else {
        console.error('Error: data.item is not an array or is undefined.');
      }
    });
    
seasonSelect.addEventListener('change', () => {
  let selectedSeason = seasonSelect.value;
  console.log('Selected Season:', selectedSeason);
});

    
  })
  .catch(error => console.error('Error fetching data:', error));

