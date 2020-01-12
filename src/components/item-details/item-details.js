import React, { Component } from 'react';

import ErrorButton from '../error-button/error-button';

import './item-details.css';

const Record = ({ item, field, label }) => {
  return (
    <li className="list-group-item">
      <span className="term">{label}</span>
      <span>{ item[field] }</span>
    </li>
  );
};

export {
  Record
};

export default class ItemDetails extends Component {

  state = {
    item: null,
    image: null
  };

  componentDidMount() {
    this.updateItem();
  }

  componentDidUpdate(prevProps) {
    if (this.props.itemId !== prevProps.itemId ||
      this.props.getData !== prevProps.getData ||
      this.props.getImageUrl !== prevProps.getImageUrl) {
      this.updateItem();
    }
  }

  updateItem() {
    const { itemId, getData, getImageUrl } = this.props;
    if (!itemId) {
      return;
    }

    getData(itemId)
      .then((item) => {
        this.setState({
          item,
          image: getImageUrl(item)
        });
      });
  }

  render() {

    const { item, image } = this.state;
    if (!item) {
      return <span>Select a item from a list</span>;
    }

    const { name } = item;

    return (
      <div className="item-details card">
        <div className="row">
          <img className="item-image col-xl-6 offset-xl-0 col-lg-6 offset-lg-0 col-md-6 offset-md-0 col-sm-10 offset-sm-1 col-10 offset-1"
               src={image}
               alt="item"/>

          <div className="card-body col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h4>{name}</h4>
            <ul className="list-group list-group-flush">
              {
                React.Children.map(this.props.children, (child) => {
                  return React.cloneElement(child, { item });
                })
              }
            </ul>
            <ErrorButton />
          </div>
        </div>
      </div>
    );
  }
}
