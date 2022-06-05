/**
 * creates the initial item state based on item availability
 * @param ebayItem
 * @returns {{
 * defaultPrice: *,
 * defaultMaxItemQuantity: number,
 * selectedItemIndex: number,
 * presetAttributes: {}
 * }}
 */
export const createInitialItemState = (ebayItem, itemId) => {
    let selectedItemIndex;
    let defaultPrice;
    let lowestPrice;
    let priceItemIndex = 0;
    let defaultMaxItemQuantity = 9;
    const available = window.optionAvailable;
    const presetAttributes = {};
    if (ebayItem.type === 'CONFIGURABLE' && ebayItem.configurable_attributes) {
        let variantId = parseVariantId(itemId);
        console.log(variantId);
        let availableCount = 0;
        let availableItemIndex;

        if (variantId) {
            let selectedVariant;
            for (let i = 0; i < ebayItem.items.length; i++) {
                if (ebayItem.items[i].id === itemId) {
                    priceItemIndex = selectedItemIndex = selectedVariant = i;
                    break;
                }
            }
            for (const attribute of ebayItem.items[selectedVariant].attributes) {
                if (ebayItem.configurable_attributes[attribute.name]) {
                    presetAttributes[attribute.name] = attribute.value;
                }
            }
        } else {
            for (let i = 0; i < ebayItem.items.length; i++) {
                let item = ebayItem.items[i];
                if (item.availability_status === 'IN_STOCK' && parseInt(item.quantity) > 0) {
                    availableItemIndex = i;
                    availableCount++;
                    if (!lowestPrice || parseFloat(item.price.amount) < lowestPrice) {
                        lowestPrice = parseFloat(item.price.amount);
                        priceItemIndex = i;
                    }
                }
            }

            if (availableCount === 1) {
                selectedItemIndex = availableItemIndex;
                defaultPrice = ebayItem.items[availableItemIndex].price.display_price;
                defaultMaxItemQuantity = ebayItem.items[availableItemIndex].quantity;
                for (const attribute of ebayItem.items[selectedItemIndex].attributes) {
                    if (ebayItem.configurable_attributes[attribute.name]) {
                        presetAttributes[attribute.name] = attribute.value;
                    }
                }
            } else if (availableCount > 1) {
                for (const attribute of Object.keys(ebayItem.configurable_attributes)) {
                    let attributeAvailableCount = 0;
                    let selectedValue;
                    for (const value of ebayItem.configurable_attributes[attribute]) {
                        if (available[value]) {
                            attributeAvailableCount++;
                            selectedValue = value;
                        }
                    }
                    presetAttributes[attribute] = attributeAvailableCount === 1 ? selectedValue : '';
                }
            }
        }
    } else {
        selectedItemIndex = 0;
    }

    if (!defaultPrice) {
        defaultPrice = ebayItem.items[priceItemIndex].price.display_price;
    }
    return {
        selectedItemIndex, defaultPrice, defaultMaxItemQuantity, presetAttributes
    };
};

/**
 * uses the NumberFormat method build into JS to build correct pricing information
 * @param price
 * @param currency
 * @returns {string|null}
 */
export const formatPrice = (price, currency) => {
    return new Intl.NumberFormat('de-DE', {
        style: 'currency',
        currency: currency
    }).format(price);
};

export const parseVariantId = (itemId) => {
    const regex = /(v1[|][0-9]*[|])\s*([0-9]*)/g;
    const matches = regex.exec(itemId);
    if (matches && matches.length === 3) {
        return matches[2];
    }
    return null;
};
