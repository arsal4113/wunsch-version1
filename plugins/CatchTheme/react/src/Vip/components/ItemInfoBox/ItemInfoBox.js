import React, {Component} from 'react';
import {connect} from 'react-redux';
import Selector from '../Selector/Selector';
import BuyButton from '../BuyButton/BuyButton';
import ItemPrice from './ItemPrice/ItemPrice';
import ItemTitle from './ItemTitle/ItemTitle';
import QuantitySelector from '../QuantitySelector/QuantitySelector';
import {updateSelectedItem} from '../../redux/items/items.actions';
import ExtraInfo from '../InfoBox/ExtraInfo/ExtraInfo';
import StickyBar from '../StickyBar/StickyBar';
import './ItemInfoBox.scss';

class ItemInfoBox extends Component {
    /**
     * handles the change event on item attribute inputs and sets the selected Item
     * @param input
     * @param event
     */
    handleChange = (input, event) => {
        const {value} = event.target;
        const {_updateSelectedItem, selectedItemAttributes} = this.props;
        const attributeUpdate = {
            ...selectedItemAttributes,
            [input]: value
        };
        _updateSelectedItem(this.getSelectedItemIndex(attributeUpdate), attributeUpdate);
    };

    /**
     * returns the index of the selected item in the items array
     * @param selectedAttributes
     * @returns {*}: index of selected item or undefined
     */
    getSelectedItemIndex = (selectedAttributes) => {
        const {items} = this.props.ebayItem;
        let itemFound = false;
        let count = -1;
        main:
            for (const item of items) {
                count++;
                for (const attribute of item.attributes) {
                    if(!(selectedAttributes[attribute.name]) && selectedAttributes[attribute.name] !== '') {
                        continue;
                    }
                    if (selectedAttributes[attribute.name] !== attribute.value) {
                        continue main;
                    }
                }
                itemFound = true;
                break;
            }
        return itemFound ? count : undefined;
    };

    render() {
        const {itemPrice, ebayItem, selectedItemIndex} = this.props;
        const shippingCurrency = ebayItem.items[0].shipping_options[0].shipping_cost.currency ? ebayItem.items[0].shipping_options[0].shipping_cost.currency : '';
        const shippingPrice = ebayItem.items[0].shipping_options[0].shipping_cost.amount ? ebayItem.items[0].shipping_options[0].shipping_cost.amount : '';
        const {configurable_attributes, title} = ebayItem;
        const {enabled_for_guest_checkout, eligible_for_inline_checkout} = ebayItem.items[0];
        const itemWebUrl = ebayItem.item_web_url;
        const showBuyButton = enabled_for_guest_checkout && eligible_for_inline_checkout;
        const buyButton = <BuyButton itemWebUrl={itemWebUrl} showBuyButton={showBuyButton} item={ebayItem} selectedItem={selectedItemIndex}/>;
        const attributeSelectors = configurable_attributes ? Object.entries(configurable_attributes).map(([attribute, value]) => (
            <div className="selector-wrapper" key={attribute}>
                <label className="col-4">{attribute}</label>
                <Selector
                    label={attribute}
                    options={value}
                    onChange={(event) => { this.handleChange(attribute, event); }}
                />
            </div>
        )) : '';
        return (
            <div id="item-info-box">
                <ItemPrice itemPrice={itemPrice}/>
                <ItemTitle itemTitle={title}/>
                {attributeSelectors}
                <QuantitySelector/>
                <StickyBar
                    item={ebayItem}
                    itemPrice={itemPrice}
                    selectedItemIndex={selectedItemIndex}
                    confAttributes={configurable_attributes}
                    changeHandler={this.handleChange}
                    buyButton={buyButton}
                />
                {buyButton}
                <ExtraInfo
                    shippingDate={shippingDate}
                    shippingCurrency={shippingCurrency}
                    shippingPrice={shippingPrice}
                />
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    ebayItem: state.items.ebayItem,
    selectedItemIndex: state.items.selectedItemIndex,
    itemPrice: state.items.itemPrice,
    selectedItemAttributes: state.items.selectedItemAttributes
});

const mapDispatchToProps = (dispatch) => ({
    _updateSelectedItem: (itemIndex, selectedItemAttributes) => dispatch(updateSelectedItem(itemIndex, selectedItemAttributes))
});

export default connect(mapStateToProps, mapDispatchToProps)(ItemInfoBox);
