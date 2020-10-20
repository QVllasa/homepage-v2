import {Component, Input} from '@angular/core';
import {ContactDialogComponent} from "../../pages/home/home.component";
import {MatDialog} from "@angular/material/dialog";


@Component({
    selector: 'app-sidenav',
    templateUrl: './sidenav.component.html',
    styleUrls: ['./sidenav.component.scss']
})
export class SidenavComponent {

    @Input() state: boolean;

    routerLinks: {name: string, path: string, section: string, class: string }[] = [
        {
            name: 'Home',
            path: '/home',
            section: 'home',
            class: 'active'
        },
        {
            name: 'About',
            path: '/home',
            section: 'about',
            class: 'active'
        },
        {
            name: 'Stack',
            path: '/home',
            section: 'stack',
            class: 'active'
        },
        {
            name: 'Services',
            path: '/home',
            section: 'services',
            class: 'active'
        },
        {
            name: 'Portfolio',
            path: '/home',
            section: 'portfolio',
            class: 'active'
        }
    ]

    constructor(public dialog: MatDialog) {
    }



    openDialog() {
        const dialogRef = this.dialog.open(ContactDialogComponent,
            {
                width: 'auto',
                panelClass: 'custom-dialog-container'
            }
        );


    }

}
