import {Component} from '@angular/core';
import {ContactDialogComponent} from "../../pages/home/home.component";
import {MatDialog} from "@angular/material/dialog";


@Component({
  selector: 'app-sidenav',
  templateUrl: './sidenav.component.html',
  styleUrls: ['./sidenav.component.scss']
})
export class SidenavComponent {

    constructor(public dialog: MatDialog) {}

    openDialog() {
        const dialogRef = this.dialog.open(ContactDialogComponent,
            {
                width: 'auto',
                panelClass: 'custom-dialog-container'
            }
        );



    }

}
