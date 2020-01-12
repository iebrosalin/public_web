import React from 'react';
import PropTypes from 'prop-types';

import './row.css';

const Row = ({ left, right }) => {
  return (
    <div className="row mb2">
      <div className="col-lg-6 mb-2">
        {left}
      </div>
      <div className="col-lg-6 mb-2">
        {right}
      </div>
    </div>
  );
};

Row.propTypes = {
  left: PropTypes.node,
  right: PropTypes.node
};

export default Row;
