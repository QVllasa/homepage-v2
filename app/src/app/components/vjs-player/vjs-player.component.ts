// vjs-player.component.ts
import {
    Component,
    ElementRef,
    EventEmitter,
    Input,
    OnDestroy,
    OnInit,
    Output,
    ViewChild,
    ViewEncapsulation
} from '@angular/core';
import videojs from 'video.js';

@Component({
    selector: 'app-vjs-player',
    template: `
        <video #target class="video-js" controls muted playsinline preload="auto"></video>
    `,
    styleUrls: [
        './vjs-player.component.scss'
    ],
    encapsulation: ViewEncapsulation.None,
})
export class VjsPlayerComponent implements OnInit, OnDestroy {
    @ViewChild('target', {static: true}) target: ElementRef;
    // see options: https://github.com/videojs/video.js/blob/mastertutorial-options.html
    @Input() options: {
        fluid: boolean,
        loop: boolean,
        controls: boolean,
        autoplay: boolean,
        sources: {
            src: string,
            type: string,
        }[],
    };

    @Output() ready = new EventEmitter<boolean>();

    isReady: boolean;

    player: videojs.Player;

    constructor(
        private elementRef: ElementRef,
    ) {
    }

    ngOnInit() {
        console.log(this.options);
        // instantiate Video.js
        this.player = videojs(this.target.nativeElement, this.options, function onPlayerReady() {
            console.log('onPlayerReady', this);
        });

        this.player.ready(() => {
                this.player.on('progress',() => {
                    if (this.player.bufferedPercent() > .05) {
                        this.ready.emit(true);
                    }
                })
            }
        )
    }

    ngOnDestroy() {
        // destroy player
        if (this.player) {
            this.player.dispose();
        }
    }
}
