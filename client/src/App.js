import React, { Component } from 'react';
import './App.css';
import PropTypes from 'prop-types';
import classNames from 'classnames';
import AppBar from "material-ui/es/AppBar/AppBar";
import Toolbar from "material-ui/es/Toolbar/Toolbar";
import Typography from "material-ui/es/Typography/Typography";
import Grid from "material-ui/es/Grid/Grid";
import {withStyles} from "material-ui/styles/index";
import Divider from "material-ui/es/Divider/Divider";
import List from "material-ui/es/List/List";
import Drawer from "material-ui/es/Drawer/Drawer";
import ListItem from "material-ui/es/List/ListItem";
import ListItemIcon from "material-ui/es/List/ListItemIcon";
import ListItemText from "material-ui/es/List/ListItemText";
import ListSubheader from "material-ui/es/List/ListSubheader";
import DraftsIcon from '@material-ui/icons/Drafts';
import SendIcon from '@material-ui/icons/Send';

const drawerWidth = 240;

const styles = theme => ({
    root: {
        flexGrow: 1,
    },
    appFrame: {
        height: '100vh',
        zIndex: 1,
        overflow: 'hidden',
        position: 'relative',
        display: 'flex',
        width: '100vw',
    },
    appBar: {
        width: `calc(100% - ${drawerWidth}px)`,
    },
    'appBar-left': {
        marginLeft: drawerWidth,
    },
    drawerPaper: {
        position: 'relative',
        width: drawerWidth,
    },
    toolbar: theme.mixins.toolbar,
    content: {
        flexGrow: 1,
        backgroundColor: theme.palette.background.default,
        padding: theme.spacing.unit * 3,
    },
});

class App extends Component {

  render() {
    const { classes } = this.props;

    const drawer = (
      <Drawer
          variant="permanent"
          classes={{
              paper: classes.drawerPaper,
          }}
          anchor={'left'}>
              <div className={classes.toolbar} />
              <Divider />
              <List
                  component="nav"
                  subheader={<ListSubheader component="div">Nested List Items</ListSubheader>}
              >
              <Divider />
                  <ListItem button>
                      <ListItemIcon>
                          <SendIcon />
                      </ListItemIcon>
                      <ListItemText inset primary="Sent mail" />
                  </ListItem>
                  <ListItem button>
                      <ListItemIcon>
                          <DraftsIcon />
                      </ListItemIcon>
                      <ListItemText inset primary="Drafts" />
                  </ListItem>
              </List>
      </Drawer>
    );

    return (
        <div className="App">
          <div className={classes.root}>
              <Grid container spacing={0}>
                  <Grid item xs={12}>
                      <div className={classes.appFrame}>
                          <AppBar
                              position="absolute"
                              className={classNames(classes.appBar, classes[`appBar-left`])}
                          >
                              <Toolbar>
                                  <Typography variant="title" color="inherit" noWrap>
                                      Permanent drawer
                                  </Typography>
                              </Toolbar>
                          </AppBar>
                          {drawer}
                          <main className={classes.content}>
                              <div className={classes.toolbar} />
                              <Typography>{'You think water moves fast? You should see ice.'}</Typography>
                          </main>
                      </div>
                  </Grid>
              </Grid>
          </div>
        </div>
    );
  }
}

App.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(App);
