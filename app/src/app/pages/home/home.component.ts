import {AfterViewChecked, AfterViewInit, Component, ElementRef, OnDestroy, OnInit, ViewChild} from '@angular/core';
import {Apollo} from "apollo-angular";
import {BehaviorSubject, interval, Observable, Subscription} from "rxjs";
import {
    IAboutMe, IBanner, IClient,
    IExperience,
    IMainPage,
    IProfileImage, IProject, IService,
    ISkill,
    IStack,
    Models
} from "../../models/models";
import {
    typeWriterText
} from "../../../static/data";
import {environment} from "../../../environments/environment";
import {MatDialog, MatDialogRef} from "@angular/material/dialog";
import {fadeInRight400ms} from "../../components/animations/fade-in-right.animation";
import {ActivatedRoute, Router, Scroll} from "@angular/router";
import {ViewportScroller} from "@angular/common";
import {filter} from "rxjs/operators";
import {DomSanitizer} from "@angular/platform-browser";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {HttpClient, HttpHeaders} from "@angular/common/http";


interface IMessage{
    sendFrom: string,
    subject: string,
    content: string,
}

@Component({
    selector: 'app-home',
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.scss'],
    animations: [
        fadeInRight400ms,

    ]
})
export class HomeComponent implements OnInit, OnDestroy, AfterViewInit {

    image: boolean;
    video: boolean;

    vjsOptions = [];


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
    servicePost: IService[] = [];
    projects: IProject[] = [];

    onReady: boolean;

    serverPath = environment.apiUrl;

    sub: Subscription;
    fragment = new BehaviorSubject<string>(null);

    private querySubscription: Subscription;

    constructor(private apollo: Apollo,
                public dialog: MatDialog,
                private route: ActivatedRoute,
                private viewportScroller: ViewportScroller,
                private sanitizer: DomSanitizer
    ) {
    }

    ngOnInit() {
        this.route.fragment.subscribe((fragment: string) => {
            this.fragment.next(fragment);
        });
        this.isLoading = true;
        this.video = false;
        this.image = true;
        this.sub = interval(7500).subscribe(x => {
            this.toggleActive();
        });
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
                this.servicePost = [];
                this.vjsOptions = [];

                for (let profileImage of data.profileImages.edges) {
                    this.profileImages.push(profileImage.node)
                }

                for (let banner of data.banners.edges) {
                    if (banner.node.mimeType === 'text/plain') {
                        let url = this.serverPath + banner.node.contentUrl;
                        this.sanitizer.bypassSecurityTrustResourceUrl(url);
                        this.vjsOptions.push(
                            {
                                fluid: true,
                                loop: true,
                                controls: false,
                                autoplay: true,
                                sources: [{
                                    src: url,
                                    type: 'application/x-mpegURL'
                                }]
                            }
                        )
                        console.log(this.vjsOptions);
                    }
                    this.banners.push(banner.node)
                }

                for (let experience of data.experiences.edges) {
                    this.experiences.push(experience.node)
                }

                for (let skill of data.skills.edges) {
                    this.skills.push(skill.node);
                }

                for (let stack of data.stacks.edges) {
                    this.sanitizer.bypassSecurityTrustResourceUrl(stack.node.url);
                    this.stacks.push(stack.node);
                }

                for (let company of data.clients.edges) {
                    this.sanitizer.bypassSecurityTrustUrl(company.node.url);
                    this.clients.push(company.node);
                }

                for (let service of data.services.edges) {
                    this.servicePost.push(service.node);
                }

                this.servicePost = this.servicePost.sort((a, b) => a.priority - b.priority);

                for (let project of data.projects.edges) {
                    this.projects.push(project.node)
                }


                this.isLoading = loading;
                if (error) {
                    console.log(error);
                }


            });
    }


    ngAfterViewInit(): void {
        // if (!this.isLoading) {
        this.fragment.subscribe(f => {

            if (this.fragment) {
                this.viewportScroller.scrollToAnchor(f);
            }

        })
        // }

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
        for (let img of this.banners) {
            if (img.mimeType === 'image/jpeg') {
                event.target.src = this.serverPath + img.contentUrl;
            }
        }
    }

    checkVideo(event: boolean){
        this.onReady = event;
    }


    toggleActive() {
        console.log(this.onReady);
        if (this.onReady){
            this.video = !this.video;
            this.image = !this.image;
        }
    }

    ngOnDestroy() {
        this.sub.unsubscribe();
    }

}

@Component({
    selector: 'app-contact-dialog',
    templateUrl: './contact-dialog.component.html'
})

export class ContactDialogComponent implements OnInit {

    form = new FormGroup({
        email: new FormControl('', [Validators.required, Validators.email]),
        subject: new FormControl('', [Validators.required]),
        content: new FormControl('', [Validators.required])
    });


    constructor(public dialogRef: MatDialogRef<ContactDialogComponent>,
                private http: HttpClient) {
    }

    ngOnInit() {
    }

    close() {
        this.dialogRef.close(true);
    }

    onSubmit(){
        const message: IMessage = {
            sendFrom: this.form.get('email').value,
            subject: this.form.get('subject').value,
            content: this.form.get('content').value
        }
        const headers = new HttpHeaders({'Content-Type':'application/json; charset=utf-8'});
        console.log(JSON.stringify(this.form.value));
        this.http.post<IMessage>(environment.apiUrl + 'messages.json', message, {
            headers: headers
        })
            .subscribe(res => {
            console.log(res);
            });
    }
}


