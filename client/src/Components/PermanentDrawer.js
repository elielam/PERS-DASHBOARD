import React from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';
import { withStyles } from 'material-ui/styles';
import Drawer from 'material-ui/Drawer';
import AppBar from 'material-ui/AppBar';
import Toolbar from 'material-ui/Toolbar';
import List from 'material-ui/List';
import Typography from 'material-ui/Typography';
import Divider from 'material-ui/Divider';

const drawerWidth = 240;

const styles = theme => ({
    root: {
        flexGrow: 1,
    },
    appFrame: {
        height: 430,
        zIndex: 1,
        overflow: 'hidden',
        position: 'relative',
        display: 'flex',
        width: '100%',
    },
    appBar: {
        width: `calc(100% - ${drawerWidth}px)`,
    },
    'appBar-left': {
        marginLeft: drawerWidth,
    },
    'appBar-right': {
        marginRight: drawerWidth,
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

class PermanentDrawer extends React.Component {

    render() {
        const { classes } = this.props;
        const { anchor } = this.state;

        const drawer = (
            <Drawer
                variant="permanent"
                classes={{
                    paper: classes.drawerPaper,
                }}
                anchor={anchor}
            >
                <div className={classes.toolbar} />
                <Divider />
                <List>test</List>
                <Divider />
                <List>test2</List>
            </Drawer>
        );

        let before = null;
        let after = null;

        if (anchor === 'left') {
            before = drawer;
        } else {
            after = drawer;
        }

        return (
            <div className={classes.root}>
                <div className={classes.appFrame}>
                    <AppBar
                        position="absolute"
                        className={classNames(classes.appBar, classes[`appBar-${anchor}`])}
                    >
                        <Toolbar>
                            <Typography variant="title" color="inherit" noWrap>
                                Permanent drawer
                            </Typography>
                        </Toolbar>
                    </AppBar>
                    {before}
                    <main className={classes.content}>
                        <div className={classes.toolbar} />

                    </main>
                    {after}
                </div>
            </div>
        );
    }
}

PermanentDrawer.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(PermanentDrawer);