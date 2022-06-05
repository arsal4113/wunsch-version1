import React from 'react';
import Total from '../../../Checkout/components/Totals/Total/Total';

import './Totals.scss';

const Totals = ({totals, items}) => {
    const totalJSX = totals.map(
        (total) => <Total final key={total.code} total={total} itemCount={items.length}/>
    );
    return (
        <div className="totals-wrapper">
            <div className="totals">
                {totalJSX}
            </div>
        </div>
    );
};

export default (Totals);
