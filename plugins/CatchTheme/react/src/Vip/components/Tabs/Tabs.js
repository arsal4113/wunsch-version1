import React, {useState} from 'react';
import TabButtons from './TabButtons/TabButtons';
import Attributes from './Content/Attributes/Attributes';
import Shipping from './Content/Shipping/Shipping';
import Seller from './Content/Seller/Seller';
import Returns from './Content/Returns/Returns';
import Description from './Content/Description/Description';
import Ebay from './Content/Ebay/Ebay';

import './Tabs.scss';

const Tabs = (props) => {

    const {item} = props;
    const [selectedTabState, setSelectedTabState] = useState({
        selectedTab: 'attributes'
    });
    const selectTabHandler = (tab) => {
        setSelectedTabState({
            selectedTab: tab
        });
    };
    let tabContent;
    switch (selectedTabState.selectedTab) {
        case 'attributes':
            tabContent = <Attributes item={item.items[0]}/>;
            break;
        case 'shipping':
            tabContent = <Shipping item={item.items[0]}/>;
            break;
        case 'seller':
            tabContent = <Seller item={item.items[0]}/>;
            break;
        case 'returns':
            tabContent = <Returns item={item.items[0]}/>;
            break;
        case 'description':
            tabContent = <Description item={item}/>;
            break;
        case 'ebay':
            tabContent = <Ebay />;
            break;
        default:
            tabContent = null;
    }

    return (
        <div className="tabs">
            <TabButtons selected={selectedTabState.selectedTab} tabSelector={(tab) => selectTabHandler(tab)}/>
            <div className="tab-content-wrapper">{tabContent}</div>
        </div>
    );
};

export default Tabs;
