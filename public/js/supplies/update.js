// Pass single element
const selectProduct = document.querySelector(".select-product");
const selectSupplier = document.querySelector(".select-supplier");

// Passing options (with default options)
const choicesProduct = new Choices(selectProduct, {
    silent: false,
    items: [],
    choices: [],
    renderChoiceLimit: -1,
    maxItemCount: -1,
    addItems: true,
    removeItems: true,
    removeItemButton: false,
    allowHTML: true,
    duplicateItemsAllowed: true,
    delimiter: ",",
    paste: true,
    searchEnabled: true,
    searchChoices: true,
    searchFloor: 1,
    searchResultLimit: 4,
    searchFields: ["label", "value"],
    position: "auto",
    resetScrollPosition: true,
    shouldSort: true,
    shouldSortItems: false,
    sorter: () => {},
    searchPlaceholderValue: "cari barang",
    renderSelectedChoices: "auto",
    loadingText: "Loading...",
    classNames: {
        containerOuter: "choices",
        containerInner: "choices__inner",
        input: "choices__input",
        inputCloned: "choices__input--cloned",
        list: "text-black",
        listItems: "choices__list--multiple",
        listSingle: "choices__list--single",
        listDropdown: "choices__list--dropdown",
        item: "choices__item",
        itemSelectable: "choices__item--selectable",
        itemDisabled: "choices__item--disabled",
        itemChoice: "choices__item--choice",
        placeholder: "choices__placeholder",
        group: "choices__group",
        groupHeading: "choices__heading",
        button: "choices__button",
        activeState: "is-active",
        focusState: "is-focused",
        openState: "is-open",
        disabledState: "is-disabled",
        highlightedState: "is-highlighted",
        selectedState: "is-selected",
        flippedState: "is-flipped",
        loadingState: "is-loading",
        noResults: "has-no-results",
        noChoices: "has-no-choices",
    },
    fuseOptions: {
        includeScore: true,
    },
    labelId: "",
    callbackOnInit: null,
    callbackOnCreateTemplates: null,
});

choicesProduct.setChoices(async () => {
    try {
        const productSelected = selectProduct.dataset.idProduct;
        const items = await fetch("/products");
        const results = await items.json();
        let values = [];
        results.data.map((item) => {
            if (item.id == productSelected) {
                const value = {
                    value: item.id,
                    label: item.name,
                    selected: true,
                };
                values.push(value);
            } else {
                const value = {
                    value: item.id,
                    label: item.name,
                };
                values.push(value);
            }
        });
        return values;
    } catch (err) {
        console.error(err);
    }
});

const choicesSupplier = new Choices(selectSupplier, {
    silent: false,
    items: [],
    choices: [],
    renderChoiceLimit: -1,
    maxItemCount: -1,
    addItems: true,
    removeItems: true,
    removeItemButton: false,
    allowHTML: true,
    duplicateItemsAllowed: true,
    delimiter: ",",
    paste: true,
    searchEnabled: true,
    searchChoices: true,
    searchFloor: 1,
    searchResultLimit: 4,
    searchFields: ["label", "value"],
    position: "auto",
    resetScrollPosition: true,
    shouldSort: true,
    shouldSortItems: false,
    sorter: () => {},
    searchPlaceholderValue: "cari barang",
    renderSelectedChoices: "auto",
    loadingText: "Loading...",
    classNames: {
        containerOuter: "choices",
        containerInner: "choices__inner",
        input: "choices__input",
        inputCloned: "choices__input--cloned",
        list: "text-black",
        listItems: "choices__list--multiple",
        listSingle: "choices__list--single",
        listDropdown: "choices__list--dropdown",
        item: "choices__item",
        itemSelectable: "choices__item--selectable",
        itemDisabled: "choices__item--disabled",
        itemChoice: "choices__item--choice",
        placeholder: "choices__placeholder",
        group: "choices__group",
        groupHeading: "choices__heading",
        button: "choices__button",
        activeState: "is-active",
        focusState: "is-focused",
        openState: "is-open",
        disabledState: "is-disabled",
        highlightedState: "is-highlighted",
        selectedState: "is-selected",
        flippedState: "is-flipped",
        loadingState: "is-loading",
        noResults: "has-no-results",
        noChoices: "has-no-choices",
    },
    fuseOptions: {
        includeScore: true,
    },
    labelId: "",
    callbackOnInit: null,
    callbackOnCreateTemplates: null,
});

choicesSupplier.setChoices(async () => {
    try {
        const supplierSelected = selectSupplier.dataset.idSupplier;
        const items = await fetch("/suppliers");
        const results = await items.json();
        let values = [];
        results.data.map((item) => {
            if (item.id == supplierSelected) {
                const value = {
                    value: item.id,
                    label: item.name,
                    selected: true,
                };
                values.push(value);
            } else {
                const value = {
                    value: item.id,
                    label: item.name,
                };
                values.push(value);
            }
        });
        return values;
    } catch (err) {
        console.error(err);
    }
});
