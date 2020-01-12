import React from 'react';
import { StarshipList } from '../sw-components';
import { withRouter } from 'react-router-dom';
import Row from "../row";
import AdBlock from "../ad-block";


const StarshipsPage = ({ history }) => {
  return (
      <Row
    left={<StarshipList onItemSelected={(id) => history.push(id)} />}
    right={<AdBlock />}
  />
  );
};

export default withRouter(StarshipsPage);
