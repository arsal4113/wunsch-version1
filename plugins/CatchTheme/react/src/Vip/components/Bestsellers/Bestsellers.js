import React, {Component} from 'react';
import {withTranslation} from 'react-i18next';
import Card from '../ItemsSlider/Card/Card';

import './Bestsellers.scss';

class Bestsellers extends Component {
    constructor(props) {
        super(props);
        this.state = {
            bestsellingItems: window.topSoldItems,
            page: 1,
            perPageLimit: 24,
            isFetching: false
        };
        this.loadMoreBestsellers = this.loadMoreBestsellers.bind(this);
        this.loadingSuccess = this.loadingSuccess.bind(this);
        this.loadingFailure = this.loadingFailure.bind(this);
    }

    loadingSuccess(items, page) {
        this.setState((prevState) => {
            const bestsellingItems = prevState.bestsellingItems.concat(items);
            return {
                bestsellingItems,
                page,
                isFetching: false
            };
        });
    }

    loadingFailure() {
        this.setState({isFetching: false});
    }

    loadMoreBestsellers() {
        const {
            page, bestsellingItems, isFetching, perPageLimit
        } = this.state;
        const categoryPath = encodeURIComponent(bestsellingItems[0].category_path.split('|')[0]);
        const requestUrl = `${window.loadMoreBestsellingItemsUrl}
        ?page=${page + 1}&ebayCategoryPath=${categoryPath}&limit=${perPageLimit}&type=react`;
        if (!isFetching) {
            this.setState({isFetching: true});
            fetch(requestUrl,
                {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then((res) => res.json())
                .then((response) => {
                    console.log('response:', response);
                    if (response.error) {
                        throw response;
                    }
                    this.loadingSuccess(response, page + 1);
                })
                .catch((error) => {
                    console.error('Something went wrong');
                    this.loadingFailure(error);
                });
        }
    }

    render() {
        const {
            bestsellingItems, page, perPageLimit, isFetching
        } = this.state;
        const {t} = this.props;
        const itemCards = bestsellingItems.map((item) => (
            <Card
                key={item.item_legacy_id}
                item={item}
                isBestseller
                showItemPrice
                showWishlist
            />
        ));
        const loadMoreButton = bestsellingItems.length === page * perPageLimit
            ? (
                <div className="button-container">
                    <div className={`button-wrapper${isFetching ? ' loading' : ''}`}>
                        <div className="loader"/>
                        <button type="button" className="load-more" onClick={this.loadMoreBestsellers}>
                            {t('Load more')}
                        </button>
                    </div>
                </div>
            ) : null;
        return (
            <div className="bestseller-wrapper">
                <p className="headline">{t('Our bestsellers')}</p>
                <div className="item-card-wrapper">
                    {itemCards}
                </div>
                {loadMoreButton}
            </div>
        );
    }
}

export default withTranslation('vip')(Bestsellers);
