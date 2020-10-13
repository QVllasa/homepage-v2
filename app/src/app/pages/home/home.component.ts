import {Component, NgZone, OnInit} from '@angular/core';
import {Apollo} from "apollo-angular";
import {Subscription} from "rxjs";
import {
    IAboutMe, IBanner, IClient,
    IExperience,
    IMainPage,
    IProfileImage, IProject, IService,
    ISkill,
    IStack, ITestimonial,
    Models
} from "../../models/models";
import {
    typeWriterText
} from "../../../static/data";
import {BASE_PATH} from "../../../environments/environment";
import {MatDialog, MatDialogRef} from "@angular/material/dialog";
import {fadeInUp400ms} from "../../components/animations/fade-in-up.animation";
import {OwlOptions} from "ngx-owl-carousel-o";


@Component({
    selector: 'app-home',
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.scss'],
    animations: [
        fadeInUp400ms
    ]
})
export class HomeComponent implements OnInit {

    customOptions: OwlOptions = {
        animateOut: 'fadeOut',
        items: 1,
        mouseDrag: false,
        touchDrag: false,
        loop: true,
        autoplay: true,
        center: true,
        dots: false,
        autoHeight: true,
        lazyLoadEager: 1,
        autoWidth: true,
        navSpeed: 100,
        autoplayTimeout: 10000,
        responsive: {
            0: {
                items: 1,
                autoplay: false,
                loop: false,
            },
            960: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    }

    vjsOptions = {
        fluid: false,
        loop: true,
        controls: false,
        autoplay: true,
        sources: [{ src: '/assets/mov/index.m3u8', type: 'application/x-mpegURL'}]
    }

    isLoading: boolean;
    query = Models;

    typeWriterText = typeWriterText;

    aboutMe: IAboutMe;
    banners: IBanner[];
    profileImages: IProfileImage[] = [];
    experiences: IExperience[] = [];
    clients: IClient[] = [];
    stacks: IStack[] = [];
    skills: ISkill[] = [];
    services: IService[] = [];
    projects: IProject[] = [];

    serverPath = BASE_PATH;

    private querySubscription: Subscription;

    constructor(private apollo: Apollo,
                public dialog: MatDialog,
    ) {
    }

    ngOnInit() {
        this.isLoading = true;
        this.querySubscription = this.apollo.watchQuery<IMainPage>({query: this.query}).valueChanges
            .subscribe(({data, error, loading}) => {
                this.profileImages = [];
                this.banners = [];
                this.aboutMe = data.aboutMe;
                this.experiences = [];
                this.skills = [];
                this.stacks = [];
                this.clients = [];
                this.projects = [];
                this.services = [];

                for (let profileImage of data.profileImages.edges) {
                    this.profileImages.push(profileImage.node)
                }

                for (let banner of data.banners.edges) {
                    this.banners.push(banner.node)
                }

                console.log(this.banners);

                for (let exp of data.experiences.edges) {
                    this.experiences.push(exp.node)
                }

                for (let skill of data.skills.edges) {
                    this.skills.push(skill.node);
                }

                for (let stack of data.stacks.edges) {
                    this.stacks.push(stack.node);
                }

                for (let company of data.clients.edges) {
                    this.clients.push(company.node);
                }

                for (let service of data.services.edges) {
                    this.services.push(service.node);
                }

                this.services = this.services.sort((a, b) => a.priority - b.priority);

                for (let project of data.projects.edges) {
                    this.projects.push(project.node)
                }


                this.isLoading = loading;
                if (error) {
                    console.log(error);
                }

            });
    }

    openDialog() {
        const dialogRef = this.dialog.open(ContactDialogComponent,
            {
                width: 'auto',
                panelClass: 'custom-dialog-container',
                backdropClass: ''
            }
        );

        dialogRef.afterClosed().subscribe();

    }

    errorHandler(event, banner: IBanner) {
        for (let img of this.banners){
            if (img.mimeType === 'image/jpeg'){
                event.target.src = this.serverPath+img.contentUrl;
                console.log(event.target.src);
            }
        }
    }

}

@Component({
    selector: 'app-contact-dialog',
    templateUrl: './contact-dialog.component.html'
})
export class ContactDialogComponent implements OnInit {

    constructor(public dialogRef: MatDialogRef<ContactDialogComponent>) {
    }

    ngOnInit() {
    }

    close() {
        this.dialogRef.close(true);
    }
}


