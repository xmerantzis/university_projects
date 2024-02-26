function [xq, centers, D] = lloydMaxQuantizer(x, N, min_value, max_value)

    % Calculate centers.
    centers = [];
    centers(1) = max_value - ((max_value - min_value) / 2^N)/2;
    for i=2:2^N
        centers(i) = centers(i-1) - (max_value - min_value) / 2^N;
    end
    centers = flip(centers);
    centers = [min_value centers max_value];
    
    %normalise input between min and max values
    x = normalize(x, 'range', [min_value max_value]);
    
    % distortion for every loop, begins with 0 and 1 for first loop
    D = [0 1];
    
    %while |Di - Di+1| < ε
    k = 2;
    while abs(D(k) - D(k-1)) >= eps
        xq = [];
        avgDistance = 0;
        count = zeros(length(centers));
        avgCount = zeros(length(centers));
    
        % calculate the zones 
        zones = [];
        zones(1) = min_value;
        for i=2:(length(centers)-2)
            zones(i) = (centers(i) + centers(i+1))/2;
        end
        zones(i+1) = max_value;
    
        % Loop through the input
        for i=1:length(x)
            % Loop through each zone
            for j=1:(length(zones)-1)
                %if x(i) is between 2 zones
                if zones(j) < x(i) && x(i) <= zones(j+1)
                    xq(i) = j;
                    % calculate average distance from center and for the next
                    % zones
                    avgDistance = avgDistance + abs(centers(j+1) - x(i));
                    avgCount(j) = avgCount(j) + x(i);
                    count(j)   = count(j) + 1;
                end
            end
            % for the cases where x(i) is the min or max value
            if x(i) == zones(1)
                xq(i) = 1;
                avgDistance = avgDistance + abs(centers(2) - x(i));
                avgCount(1) = avgCount(1) + x(i);
                count(1)   = count(1) + 1;
            end
        end
        % new distortion into Distortion vector and next loop
        avg_distortion = avgDistance/length(x);
        D = [D avg_distortion];
        k = k + 1;
    
        % Calculate centers for the next zones
        for j=2:(length(centers)-1)
            if count(j-1) ~= 0
                centers(j) = avgCount(j-1)/count(j-1);
            end
        end
    end 
    % remove unnecessary elements and fix vectors D, centers and xq
    D(1) = [];
    D(2) = [];
    centers(1) = [];
    centers(length(centers)) = [];
    xq = xq';
    fprintf('Number of iterations: %d\n', k);
end