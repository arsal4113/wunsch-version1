import React from 'react';
import { connect } from 'react-redux';
import {withTranslation} from 'react-i18next';
import Total from './Total/Total';
import Headline from '../UI/Headlines/Headline';
import './Totals.scss';

// eslint-disable-next-line react/prefer-stateless-function
class Totals extends React.Component {
    render() {
        const { totals, items, t } = this.props;
        const totalJSX = totals.map(
            (total) => <Total key={total.code} total={total} itemCount={items.length}/>
        );
        return (
            <div className="totals-wrapper big-box">
                <Headline text={t('totals.title')}/>
                <div className="totals">
                    {totalJSX}
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    totals: state.totals.totals,
    items: state.items.items
});

export default withTranslation('checkout')(connect(mapStateToProps)(Totals));
