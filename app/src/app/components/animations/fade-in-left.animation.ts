import { animate, style, transition, trigger } from '@angular/animations';

export function fadeInRightAnimation(duration: number) {
  return trigger('fadeInLeft', [
    transition(':enter', [
      style({
        transform: 'translateX(40px)',
        opacity: 0
      }),
      animate(`${duration}ms cubic-bezier(0.35, 0, 0.25, 1)`, style({
        transform: 'translateX(0)',
        opacity: 1
      }))
    ])
  ]);
}

export const fadeInLeft400ms = fadeInRightAnimation(400);
export const fadeInLeft800ms = fadeInRightAnimation(800);
export const fadeInLeft1600ms = fadeInRightAnimation(1600);
