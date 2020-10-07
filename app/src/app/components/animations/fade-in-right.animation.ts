import { animate, style, transition, trigger } from '@angular/animations';

export function fadeInRightAnimation(duration: number) {
  return trigger('fadeInRight', [
    transition(':enter', [
      style({
        transform: 'translateX(-40px)',
        opacity: 0
      }),
      animate(`${duration}ms cubic-bezier(0.35, 0, 0.25, 1)`, style({
        transform: 'translateX(0)',
        opacity: 1
      }))
    ])
  ]);
}

export const fadeInRight400ms = fadeInRightAnimation(400);
export const fadeInRight800ms = fadeInRightAnimation(800);
export const fadeInRight1600ms = fadeInRightAnimation(1600);
