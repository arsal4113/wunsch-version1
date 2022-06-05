import {
    ADD_ITEM_TO_CART_FAILURE,
    ADD_ITEM_TO_CART_START, ADD_ITEM_TO_CART_SUCCESS, HIDE_MOBILE_POPUP, SHOW_MOBILE_POPUP,
    UPDATE_ITEM_QUANTITY,
    UPDATE_SELECTED_ITEM
} from '../actionTypes';
import {createInitialItemState} from '../../helper';

const {ebayItem, itemId} = window;
const {
    selectedItemIndex, defaultPrice, defaultMaxItemQuantity, presetAttributes
} = createInitialItemState(ebayItem, itemId);

const initialState = {
    ebayItem: ebayItem,
    selectedItemIndex: selectedItemIndex,
    itemPrice: defaultPrice,
    itemQuantity: 1,
    maxItemQuantity: defaultMaxItemQuantity,
    isFetching: false,
    error: undefined,
    selectedItemAttributes: presetAttributes,
    showMobilePopup: false
};

const itemsReducer = (state = initialState, action) => {
    switch (action.type) {
        case UPDATE_SELECTED_ITEM:
            // eslint-disable-next-line no-case-declarations
            const currentItem = action.index === undefined
                ? undefined : state.ebayItem.items[action.index];
            // eslint-disable-next-line no-case-declarations
            const maxItemQuantity = currentItem
                && currentItem.quantity_type === 'EXACT'
                && currentItem.quantity < defaultMaxItemQuantity
                ? currentItem.quantity : defaultMaxItemQuantity;
            // eslint-disable-next-line no-case-declarations
            const itemPrice = currentItem ? currentItem.price.display_price : defaultPrice;
            return {
                ...state,
                selectedItemIndex: action.index,
                itemPrice: itemPrice,
                maxItemQuantity: maxItemQuantity,
                itemQuantity: state.itemQuantity > maxItemQuantity ? maxItemQuantity : state.itemQuantity,
                selectedItemAttributes: action.attributes
            };
        case UPDATE_ITEM_QUANTITY:
            return {
                ...state,
                itemQuantity: action.payload
            };
        case ADD_ITEM_TO_CART_START:
            return {
                ...state,
                isFetching: true,
                error: undefined
            };
        case ADD_ITEM_TO_CART_SUCCESS:
            return {
                ...state,
                isFetching: false
            };
        case ADD_ITEM_TO_CART_FAILURE:
            return {
                ...state,
                isFetching: false,
                error: action.payload
            };
        case SHOW_MOBILE_POPUP:
            return {
                ...state,
                showMobilePopup: true
            };
        case HIDE_MOBILE_POPUP:
            return {
                ...state,
                showMobilePopup: false
            };
        default:
            return state;
    }
};

export default itemsReducer;
