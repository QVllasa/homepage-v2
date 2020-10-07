import { animate, style, transition, trigger } from '@angular/animations';

export function fadeInUpAnimation(duration: number) {
  return trigger('fadeInUp', [
    transition(':enter', [
      style({
        transform: 'translateY(40px)',
        opacity: 0
      }),
      animate(`${duration}ms cubic-bezier(0.35, 0, 0.25, 1)`, style({
        transform: 'translateY(0)',
        opacity: 1
      }))
    ])
  ]);
}

export const fadeInUp400ms = fadeInUpAnimation(400);
export const fadeInUp800ms = fadeInUpAnimation(800);
export const fadeInUp1600ms = fadeInUpAnimation(1600);
